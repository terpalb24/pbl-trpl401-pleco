<div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.09)] border border-slate-100 p-6 mb-8">
    <!-- Header Fitur -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h3 class="font-bold text-slate-800 text-xl tracking-tight">Lokasi Robot</h3>
            <p class="text-slate-500 text-sm mt-1">Pantau pergerakan robot.</p>
        </div>
        
        <!-- Status Badge -->
        <div class="flex items-center space-x-2">
            <span class="relative flex h-3 w-3">
                <span id="ping-indicator" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                <span id="status-indicator" class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
            </span>
            <span id="status-text" class="text-sm font-semibold text-slate-600">Menghubungkan...</span>
        </div>
    </div>

    <!-- Peta Leaflet (Full Width) -->
    <div class="relative z-10 mb-6">
        <div id="robot-map" class="h-[420px] w-full rounded-2xl border border-slate-200 shadow-sm z-0"></div>
    </div>

    <!-- Parameter Cards (Horizontal Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Lokasi Koordinat -->
        <div class="bg-slate-50/70 p-5 rounded-2xl border border-slate-100 shadow-2xs flex flex-col space-y-4">
            <!-- Header: Icon & Text -->
            <div class="flex items-center gap-2.5 pb-2.5 border-b border-slate-100/80">
                <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Koordinat Terkini</span>
            </div>
            <!-- Content: Coordinates Grid -->
            <div class="grid grid-cols-2 gap-3 pt-0.5">
                <div class="text-xs font-mono bg-white px-3 py-2.5 rounded-xl border border-slate-200/60 flex flex-col shadow-3xs">
                    <span class="text-slate-400 font-sans text-[10px] uppercase font-bold tracking-wider mb-1">Garis Lintang</span>
                    <span id="param-lat" class="font-semibold text-slate-800 text-sm">-</span>
                </div>
                <div class="text-xs font-mono bg-white px-3 py-2.5 rounded-xl border border-slate-200/60 flex flex-col shadow-3xs">
                    <span class="text-slate-400 font-sans text-[10px] uppercase font-bold tracking-wider mb-1">Garis Bujur</span>
                    <span id="param-lng" class="font-semibold text-slate-800 text-sm">-</span>
                </div>
            </div>
        </div>

        <!-- Indikator Baterai -->
        <div class="bg-slate-50/70 p-5 rounded-2xl border border-slate-100 shadow-2xs flex flex-col space-y-4">
            <!-- Header: Icon & Text -->
            <div class="flex items-center justify-between pb-2.5 border-b border-slate-100/80">
                <div class="flex items-center gap-2.5">
                    <div class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Daya Baterai</span>
                </div>
            </div>
            <!-- Content: Unified Battery Card -->
            <div class="bg-white px-3 py-2.5 rounded-xl border border-slate-200/60 shadow-3xs flex items-center justify-between min-h-[58px]">
                <div class="flex flex-col shrink-0">
                    <span class="text-slate-400 font-sans text-[10px] uppercase font-bold tracking-wider mb-1">Status Kapasitas</span>
                    <span id="param-battery-text" class="font-semibold text-slate-800 text-sm">0%</span>
                </div>
                <div class="flex-1 max-w-[160px] ml-4">
                    <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden p-0.5">
                        <div id="param-battery-bar" class="bg-emerald-500 h-2 rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Inisialisasi Leaflet Map ---
        // Lokasi awal (Danau Batam Center)
        const defaultLat = 1.1278;
        const defaultLng = 104.0532;
        
        const map = L.map('robot-map', {
            zoomControl: true,
            scrollWheelZoom: true
        }).setView([defaultLat, defaultLng], 16);

        // Tile layer menggunakan CartoDB Voyager yang bersih dan bernuansa premium
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            maxZoom: 20
        }).addTo(map);

        // Path jejak robot (Polyline)
        const robotPath = L.polyline([], {
            color: '#3b82f6', // blue-500
            weight: 4,
            opacity: 0.8,
            dashArray: '6, 8',
            lineCap: 'round',
            lineJoin: 'round'
        }).addTo(map);

        // Custom Marker Robot (dengan indikator ping berkedip dan rotasi arah)
        const robotIcon = L.divIcon({
            html: `
                <div class="relative flex items-center justify-center w-8 h-8">
                    <div id="marker-ping" class="absolute w-8 h-8 rounded-full bg-blue-500 opacity-25 animate-ping"></div>
                    <div id="marker-direction" class="w-6 h-6 rounded-full bg-blue-600 border-2 border-white shadow-md flex items-center justify-center text-white transition-transform duration-300" style="transform: rotate(0deg);">
                        <!-- Arrow SVG -->
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 10l7-7 7 7M12 3v18"></path>
                        </svg>
                    </div>
                </div>
            `,
            className: '',
            iconSize: [32, 32],
            iconAnchor: [16, 16]
        });

        const robotMarker = L.marker([defaultLat, defaultLng], { icon: robotIcon }).addTo(map);

        // --- 2. Manajemen State & Sinkronisasi UI ---
        const uiStatusIndicator = document.getElementById('status-indicator');
        const uiPingIndicator = document.getElementById('ping-indicator');
        const uiStatusText = document.getElementById('status-text');
        
        const uiParamStatus = document.getElementById('param-status');
        const uiParamSignal = document.getElementById('param-signal');
        const uiParamSpeed = document.getElementById('param-speed');
        const uiParamHeading = document.getElementById('param-heading');
        const uiParamLat = document.getElementById('param-lat');
        const uiParamLng = document.getElementById('param-lng');
        const uiParamBatteryText = document.getElementById('param-battery-text');
        const uiParamBatteryBar = document.getElementById('param-battery-bar');
        
        const markerPing = document.getElementById('marker-ping');
        const markerDirection = document.getElementById('marker-direction');

        let lastCoordinates = null;

        function updateRobotUI(data) {
            const lat = parseFloat(data.latitude).toFixed(6);
            const lng = parseFloat(data.longitude).toFixed(6);
            const speed = parseFloat(data.speed).toFixed(1);
            const heading = parseInt(data.heading || 0);
            const battery = parseInt(data.battery || 0);
            const status = data.status || 'Active';
            const signal = data.signal || 'Sangat Baik';

            // Update Teks Parameter
            if (uiParamStatus) uiParamStatus.innerText = status;
            if (uiParamSignal) uiParamSignal.innerText = signal;
            if (uiParamSpeed) uiParamSpeed.innerText = `${speed} m/s`;
            if (uiParamHeading) uiParamHeading.innerText = `${heading}°`;
            if (uiParamLat) uiParamLat.innerText = lat;
            if (uiParamLng) uiParamLng.innerText = lng;
            if (uiParamBatteryText) uiParamBatteryText.innerText = `${battery}%`;

            // Update Progress Bar Baterai
            if (uiParamBatteryBar) {
                uiParamBatteryBar.style.width = `${battery}%`;
                if (battery < 20) {
                    uiParamBatteryBar.className = "bg-red-500 h-2 rounded-full transition-all duration-500";
                } else if (battery < 50) {
                    uiParamBatteryBar.className = "bg-yellow-500 h-2 rounded-full transition-all duration-500";
                } else {
                    uiParamBatteryBar.className = "bg-emerald-500 h-2 rounded-full transition-all duration-500";
                }
            }

            // Update Marker Peta & Gambar polyline lintasan
            const newPos = [parseFloat(data.latitude), parseFloat(data.longitude)];
            robotMarker.setLatLng(newPos);
            robotPath.addLatLng(newPos);

            // Batasi panjang rute tersimpan untuk performa (maksimal 100 koordinat)
            const pathPoints = robotPath.getLatLngs();
            if (pathPoints.length > 100) {
                pathPoints.shift();
                robotPath.setLatLngs(pathPoints);
            }

            // Atur Rotasi Arah Marker (Heading)
            const directionEl = document.getElementById('marker-direction');
            if (directionEl) {
                directionEl.style.transform = `rotate(${heading}deg)`;
            }

            // Geser peta agar tetap mengikuti robot secara mulus
            map.panTo(newPos);
        }

        // --- 3. Logika Simulasi Rute (Fallback) ---
        let simulationInterval = null;
        let simRouteIndex = 0;
        let simBattery = 92;

        // Koordinat titik patroli mengelilingi Danau Batam Center
        const simPath = [
            [1.1278, 104.0532],
            [1.1283, 104.0536],
            [1.1290, 104.0543],
            [1.1296, 104.0549],
            [1.1301, 104.0542],
            [1.1306, 104.0535],
            [1.1311, 104.0527],
            [1.1304, 104.0519],
            [1.1298, 104.0513],
            [1.1290, 104.0517],
            [1.1284, 104.0522],
            [1.1280, 104.0527]
        ];

        function startSimulation() {
            if (simulationInterval) clearInterval(simulationInterval);

            // Ubah badge koneksi ke mode Simulasi
            uiStatusIndicator.className = "relative inline-flex rounded-full h-3 w-3 bg-yellow-500";
            uiPingIndicator.className = "animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75";
            uiStatusText.innerText = "Simulasi (Active)";
            uiStatusText.className = "text-sm font-semibold text-yellow-600";

            // Atur warna marker ke oranye/kuning untuk mode simulasi
            const directionEl = document.getElementById('marker-direction');
            if (directionEl) {
                directionEl.classList.remove('bg-blue-600');
                directionEl.classList.add('bg-yellow-500');
            }
            const pingEl = document.getElementById('marker-ping');
            if (pingEl) {
                pingEl.classList.remove('bg-blue-500');
                pingEl.classList.add('bg-yellow-400');
            }

            simulationInterval = setInterval(function() {
                const currentCoord = simPath[simRouteIndex];
                const nextRouteIndex = (simRouteIndex + 1) % simPath.length;
                const nextCoord = simPath[nextRouteIndex];

                // Hitung arah (heading) antara dua titik koordinat
                const dy = nextCoord[0] - currentCoord[0];
                const dx = Math.cos(Math.PI/180 * currentCoord[0]) * (nextCoord[1] - currentCoord[1]);
                let heading = Math.atan2(dx, dy) * 180 / Math.PI;
                if (heading < 0) heading += 360;

                // Tambahkan sedikit noise/variasi acak agar gerakan robot natural
                const noiseLat = (Math.random() - 0.5) * 0.0001;
                const noiseLng = (Math.random() - 0.5) * 0.0001;
                
                const finalLat = currentCoord[0] + noiseLat;
                const finalLng = currentCoord[1] + noiseLng;

                // Kurangi baterai secara lambat
                if (Math.random() > 0.8) {
                    simBattery--;
                    if (simBattery < 10) simBattery = 100; // Reset baterai jika habis
                }

                // Buat data payload tiruan mirip WebSocket
                const mockPayload = {
                    latitude: finalLat,
                    longitude: finalLng,
                    speed: (Math.random() * 0.5 + 0.8), // 0.8 - 1.3 m/s
                    heading: Math.round(heading),
                    battery: simBattery,
                    status: 'Patroli',
                    signal: Math.random() > 0.9 ? 'Baik' : 'Sangat Baik'
                };

                updateRobotUI(mockPayload);
                simRouteIndex = nextRouteIndex;
            }, 3000); // Update setiap 3 detik
        }

        function stopSimulation() {
            if (simulationInterval) {
                clearInterval(simulationInterval);
                simulationInterval = null;
            }
        }

        // --- 4. Logika WebSocket Client Real-time ---
        let socket = null;
        let reconnectTimeout = null;
        
        // Silakan sesuaikan URL WebSocket di bawah ini sesuai server WebSocket robot Anda
        const wsUrl = 'ws://127.0.0.1:8080/robot-gps';

        function connectWebSocket() {
            if (reconnectTimeout) {
                clearTimeout(reconnectTimeout);
                reconnectTimeout = null;
            }

            console.log(`[WebSocket] Menghubungkan ke ${wsUrl}...`);

            // Atur status UI ke menghubungkan
            uiStatusIndicator.className = "relative inline-flex rounded-full h-3 w-3 bg-red-500";
            uiPingIndicator.className = "animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75";
            uiStatusText.innerText = "Menghubungkan...";
            uiStatusText.className = "text-sm font-semibold text-slate-500";

            try {
                socket = new WebSocket(wsUrl);

                socket.onopen = function() {
                    console.log("[WebSocket] Terhubung dengan sukses!");
                    stopSimulation(); // Hentikan simulasi saat berhasil terhubung
                    
                    // Ubah status ke Terhubung (Live)
                    uiStatusIndicator.className = "relative inline-flex rounded-full h-3 w-3 bg-green-500";
                    uiPingIndicator.className = "animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75";
                    uiStatusText.innerText = "Terhubung (Live)";
                    uiStatusText.className = "text-sm font-semibold text-green-600";

                    // Atur warna marker ke biru untuk mode live WebSocket
                    const directionEl = document.getElementById('marker-direction');
                    if (directionEl) {
                        directionEl.classList.remove('bg-yellow-500');
                        directionEl.classList.add('bg-blue-600');
                    }
                    const pingEl = document.getElementById('marker-ping');
                    if (pingEl) {
                        pingEl.classList.remove('bg-yellow-400');
                        pingEl.classList.add('bg-blue-500');
                    }
                };

                socket.onmessage = function(event) {
                    try {
                        const data = JSON.parse(event.data);
                        updateRobotUI(data);
                    } catch (e) {
                        console.error("[WebSocket] Gagal melakukan parsing JSON data:", e);
                    }
                };

                socket.onerror = function(err) {
                    console.error("[WebSocket] Terjadi error pada koneksi.");
                };

                socket.onclose = function() {
                    console.warn("[WebSocket] Koneksi terputus. Mengaktifkan mode simulasi dan mencoba menghubungkan ulang dalam 5 detik...");
                    startSimulation();
                    
                    // Coba hubungkan kembali setelah 5 detik secara otomatis
                    reconnectTimeout = setTimeout(connectWebSocket, 5000);
                };

            } catch (e) {
                console.error("[WebSocket] Gagal inisialisasi koneksi:", e);
                startSimulation();
                reconnectTimeout = setTimeout(connectWebSocket, 5000);
            }
        }

        // Hubungkan WebSocket saat pertama kali dimuat
        connectWebSocket();
    });
</script>
