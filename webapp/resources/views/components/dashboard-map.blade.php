@props([
    'api_key' => '',
    'last_loc' => ''
])

<div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.09)] border border-slate-100 p-6 mb-8">
    <i id="api-key" data-api-key="{{ $api_key }}"></i>
    <i id="last-loc" data-last-loc="{{ $last_loc }}"></i>

    <!-- Header Fitur -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h3 class="font-bold text-slate-800 text-xl tracking-tight">Lokasi Robot</h3>
            <p class="text-slate-500 text-sm mt-1">Pantau pergerakan robot.</p>
        </div>

        <!-- Status Badge -->
        <div class="flex items-center space-x-2">
            <span class="relative flex h-3 w-3">
                <span id="ping-indicator"
                      class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                <span id="status-indicator" class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
            </span>
            <span id="status-text" class="text-sm font-semibold text-slate-600">Menghubungkan...</span>
        </div>
    </div>

    <!-- Peta Leaflet (Full Width) -->
    <div class="relative z-10 mb-6">
        <div id="robot-map" class="h-[500px] w-full border border-slate-200 shadow-sm z-0" style="height: 500px;"></div>
    </div>

    <!-- Parameter Cards (Horizontal Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Lokasi Koordinat -->
        <div class="bg-slate-50/70 p-5 rounded-2xl border border-slate-100 shadow-2xs flex flex-col space-y-4">
            <!-- Header: Icon & Text -->
            <div class="flex items-center gap-2.5 pb-2.5 border-b border-slate-100/80">
                <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Koordinat Terkini</span>
            </div>
            <!-- Content: Coordinates Grid -->
            <div class="grid grid-cols-2 gap-3 pt-0.5">
                <div
                    class="text-xs font-mono bg-white px-3 py-2.5 rounded-xl border border-slate-200/60 flex flex-col shadow-3xs">
                    <span class="text-slate-400 font-sans text-[10px] uppercase font-bold tracking-wider mb-1">Garis
                        Lintang</span>
                    <span id="param-lat" class="font-semibold text-slate-800 text-sm">-</span>
                </div>
                <div
                    class="text-xs font-mono bg-white px-3 py-2.5 rounded-xl border border-slate-200/60 flex flex-col shadow-3xs">
                    <span class="text-slate-400 font-sans text-[10px] uppercase font-bold tracking-wider mb-1">Garis
                        Bujur</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Daya Baterai</span>
                </div>
            </div>
            <!-- Content: Unified Battery Card -->
            <div
                class="bg-white px-3 py-2.5 rounded-xl border border-slate-200/60 shadow-3xs flex items-center justify-between min-h-[58px]">
                <div class="flex flex-col shrink-0">
                    <span class="text-slate-400 font-sans text-[10px] uppercase font-bold tracking-wider mb-1">Status
                        Kapasitas</span>
                    <span id="param-battery-text" class="font-semibold text-slate-800 text-sm">0%</span>
                </div>
                <div class="flex-1 max-w-[160px] ml-4">
                    <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden p-0.5">
                        <div id="param-battery-bar" class="bg-emerald-500 h-2 rounded-full transition-all duration-500"
                             style="width: 0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const uiParamLat = document.getElementById('param-lat');
    const uiParamLng = document.getElementById('param-lng');

    document.addEventListener("DOMContentLoaded", function () {
        const lastLocEl = document.getElementById("last-loc");
        let lastLoc = lastLocEl.dataset.lastLoc;

        const splittedLoc = lastLoc.split(" ");
        const defaultLat = splittedLoc[0];
        const defaultLng = splittedLoc[1];

        if (uiParamLat) uiParamLat.innerText = defaultLat;
        if (uiParamLng) uiParamLng.innerText = defaultLng;

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
        const uiParamBatteryText = document.getElementById('param-battery-text');
        const uiParamBatteryBar = document.getElementById('param-battery-bar');

        function updateRobotBattery(battery) {
            if (uiParamBatteryText) uiParamBatteryText.innerText = `${battery}%`;
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
        }

        function updateRobotUI(data) {
            const lat = parseFloat(data[0]).toFixed(6);
            const lng = parseFloat(data[1]).toFixed(6);
            const status = data.status || 'Active';

            // Update Teks Parameter
            if (uiParamStatus) uiParamStatus.innerText = status;
            if (uiParamLat) uiParamLat.innerText = lat;
            if (uiParamLng) uiParamLng.innerText = lng;

            // Update Marker Peta & Gambar polyline lintasan
            const newPos = [parseFloat(lat), parseFloat(lng)];
            robotMarker.setLatLng(newPos);
            robotPath.addLatLng(newPos);

            // Batasi panjang rute tersimpan untuk performa (maksimal 100 koordinat)
            const pathPoints = robotPath.getLatLngs();
            if (pathPoints.length > 100) {
                pathPoints.shift();
                robotPath.setLatLngs(pathPoints);
            }

            // Geser peta agar tetap mengikuti robot secara mulus
            map.panTo(newPos);
        }

        // --- 4. Logika WebSocket Client Real-time ---
        let socket = null;
        let reconnectTimeout = null;

        const wsUrl = 'ws://127.0.0.1:7777/pull'; // wss://pleco-wss.hosea.dev/pull

        function connectWebSocket() {
            if (reconnectTimeout) {
                clearTimeout(reconnectTimeout);
                reconnectTimeout = null;
            }

            // Atur status UI ke menghubungkan
            uiStatusIndicator.className = "relative inline-flex rounded-full h-3 w-3 bg-red-500";
            uiPingIndicator.className = "animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75";
            uiStatusText.innerText = "Menghubungkan...";
            uiStatusText.className = "text-sm font-semibold text-red-500";

            try {
                const apiKey = document.getElementById("api-key").dataset.apiKey;
                if (!apiKey) return;
                socket = new WebSocket(wsUrl, [apiKey]);

                socket.onopen = function () {
                    // Ubah status ke Terhubung (Live)
                    uiStatusIndicator.className = "relative inline-flex rounded-full h-3 w-3 bg-green-500";
                    uiPingIndicator.className = "animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75";
                    uiStatusText.innerText = "Terhubung";
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

                socket.onmessage = function (event) {
                    try {
                        const rawData = event.data;
                        if (rawData.startsWith('BAT:')) {
                            // Remove the prefix to fetch the real value
                            const data = event.data.replace('BAT:', '');
                            const numData = Number(data);
                            if (isNaN(numData) || numData < 0 || numData > 100) return;
                            updateRobotBattery(numData);
                        } else if (rawData.startsWith('GPS:')) {
                            // Remove the prefix to fetch the real value
                            const data = event.data.replace('GPS:', '').split(" ");
                            if (data.length !== 2) return;
                            updateRobotUI(data);
                        }
                    } catch (e) {}
                };

                socket.onerror = function () {
                    reconnectWss();
                };

                socket.onclose = function () {
                    reconnectWss();
                };

            } catch (e) {
                reconnectWss();
            }
        }

        function reconnectWss() {
            reconnectTimeout = setTimeout(connectWebSocket, 5000);
        }

        // Hubungkan WebSocket saat pertama kali dimuat
        connectWebSocket();
    });
</script>
