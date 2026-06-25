<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Dasbor Admin | PLECO</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Leaflet.js for GPS Live Tracking Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .bg-wave-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(at 0% 0%, hsla(215,98%,61%,0.08) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, hsla(199,89%,48%,0.08) 0px, transparent 50%);
        }
    </style>
</head>
<body class="bg-white">
    <x-navbar.loggedin></x-navbar.loggedin>

    <div class="flex pt-16 overflow-hidden bg-white">
        <x-sidebar-operator></x-sidebar-operator>

        <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64 bg-white min-h-screen">
            <main class="p-8">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 mt-2 gap-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-2xl tracking-tight">Analisis Sampah Terdeteksi</h2>
                        <p class="text-slate-500 text-sm mt-1">Pantau jumlah sampah yang diambil robot berdasarkan tanggal.</p>
                    </div>
                    <div class="flex items-center space-x-3 bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                        <label for="trash-date-filter" class="text-sm font-medium text-slate-600 ml-2">Tanggal:</label>
                        <input type="date" id="trash-date-filter" class="bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm font-medium focus:ring-blue-500 focus:border-blue-500 px-3 py-2 cursor-pointer outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" id="trash-cards-container">
                  <!-- Card 1 -->
                  <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.09)] border border-slate-100 p-6 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(0,0,0,0.09)] transition-all duration-300">
                     <h3 class="text-center font-bold text-slate-700 mb-4 text-lg tracking-tight">Botol Mineral</h3>
                     <img src="{{ asset('images/kategori/botol_mineral.png') }}" class="w-full h-36 object-cover rounded-xl mb-5 shadow-sm" alt="Botol Mineral">
                     <p class="text-center font-extrabold text-4xl text-slate-800 trash-count" data-base="10">10</p>
                  </div>
                  <!-- Card 2 -->
                  <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.09)] border border-slate-100 p-6 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(0,0,0,0.09)] transition-all duration-300">
                     <h3 class="text-center font-bold text-slate-700 mb-4 text-lg tracking-tight">Plastik</h3>
                     <img src="{{ asset('images/kategori/plastik.png') }}" class="w-full h-36 object-cover rounded-xl mb-5 shadow-sm" alt="Plastik">
                     <p class="text-center font-extrabold text-4xl text-slate-800 trash-count" data-base="5">5</p>
                  </div>
                  <!-- Card 3 -->
                  <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.09)] border border-slate-100 p-6 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(0,0,0,0.09)] transition-all duration-300">
                     <h3 class="text-center font-bold text-slate-700 mb-4 text-lg tracking-tight">Sterofoam</h3>
                     <img src="{{ asset('images/kategori/sterofoam.png') }}" class="w-full h-36 object-cover rounded-xl mb-5 shadow-sm" alt="Sterofoam">
                     <p class="text-center font-extrabold text-4xl text-slate-800 trash-count" data-base="7">7</p>
                  </div>
                  <!-- Card 4 -->
                  <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.09)] border border-slate-100 p-6 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(0,0,0,0.09)] transition-all duration-300">
                     <h3 class="text-center font-bold text-slate-700 mb-4 text-lg tracking-tight">Lainnya</h3>
                     <img src="{{ asset('images/kategori/lainnya.png') }}" class="w-full h-36 object-cover rounded-xl mb-5 shadow-sm" alt="Lainnya">
                     <p class="text-center font-extrabold text-4xl text-slate-800 trash-count" data-base="7">7</p>
                  </div>
                </div>

                <!-- Live GPS Tracking Map -->
                <x-dashboard-map />

                <div class="grid grid-cols-1 gap-4">
                   <!-- Activity Chart -->
                   <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.09)] border border-slate-100 p-8">
                      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                         <h3 class="font-bold text-slate-800 text-xl tracking-tight">Aktivitas</h3>
                         
                         <div class="flex items-center space-x-2">
                             <button id="prev-period" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-100 transition" title="Sebelumnya">
                                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                             </button>
                             
                             <div class="flex flex-col items-center">
                                 <select id="activity-filter" class="bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm font-medium focus:ring-blue-500 focus:border-blue-500 pl-3 pr-7 py-2 cursor-pointer shadow-sm">
                                    <option value="mingguan">Mingguan</option>
                                    <option value="bulanan" selected>Bulanan</option>
                                    <option value="tahunan">Tahunan</option>
                                 </select>
                                 <span id="period-label" class="text-xs text-slate-500 mt-1 font-medium"></span>
                             </div>

                             <button id="next-period" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-100 transition disabled:opacity-50 disabled:cursor-not-allowed" title="Selanjutnya">
                                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                             </button>
                         </div>
                      </div>
                      <div id="activity-chart"></div>
                   </div>

            </main>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentMode = 'bulanan';
            let periodOffset = 0; // 0 = current, -1 = previous

            function updatePeriodLabel() {
                const label = document.getElementById('period-label');
                const nextBtn = document.getElementById('next-period');
                nextBtn.disabled = periodOffset >= 0;

                let text = '';
                const date = new Date();
                
                if (currentMode === 'mingguan') {
                    let weekDate = new Date();
                    let currentDayIndex = weekDate.getDay() === 0 ? 7 : weekDate.getDay(); 
                    weekDate.setDate(weekDate.getDate() - currentDayIndex + 1 + (periodOffset * 7));
                    
                    let startDate = new Date(weekDate);
                    let endDate = new Date(weekDate);
                    endDate.setDate(startDate.getDate() + 6);
                    
                    let startStr = startDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                    let endStr = endDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                    
                    let weekName = "";
                    if (periodOffset === 0) weekName = "Minggu Ini ";
                    else if (periodOffset === -1) weekName = "Minggu Lalu ";
                    else weekName = Math.abs(periodOffset) + " Minggu Lalu ";

                    text = `${weekName}(${startStr} - ${endStr})`;
                } else if (currentMode === 'bulanan') {
                    date.setFullYear(date.getFullYear() + periodOffset);
                    text = "Tahun " + date.getFullYear();
                } else if (currentMode === 'tahunan') {
                    let endYear = date.getFullYear() + (periodOffset * 5);
                    let startYear = endYear - 4;
                    text = startYear + " - " + endYear;
                }
                label.innerText = text;
            }

            function generateDummyData(mode, offset) {
                let categories = [];
                let data = [];
                const date = new Date(); 
                
                if (mode === 'mingguan') {
                    categories = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    let currentDay = date.getDay() === 0 ? 7 : date.getDay(); 
                    
                    for(let i=0; i<7; i++) {
                        if (offset === 0 && (i + 1) > currentDay) {
                             data.push(0); // Future days in current week are 0
                        } else {
                             data.push(Math.floor(Math.random() * 50) + 10);
                        }
                    }
                } else if (mode === 'bulanan') {
                    categories = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
                    
                    for(let i=0; i<12; i++) {
                        if (offset === 0 && i > date.getMonth()) {
                            data.push(0); // Future months in current year are 0
                        } else {
                            data.push(Math.floor(Math.random() * 300) + 50);
                        }
                    }
                } else if (mode === 'tahunan') {
                    let endYear = date.getFullYear() + (offset * 5);
                    categories = [endYear-4, endYear-3, endYear-2, endYear-1, endYear];
                    
                    for(let i=0; i<5; i++) {
                        if (offset === 0 && i === 4) {
                             data.push(Math.floor(Math.random() * 1500) + 500); // Current year might be lower
                        } else {
                             data.push(Math.floor(Math.random() * 3000) + 1500);
                        }
                    }
                }
                return { categories, data };
            }

            const options = {
                series: [{ name: 'Aktivitas', data: [] }],
                chart: { type: 'bar', height: 320, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
                plotOptions: { bar: { borderRadius: 4, columnWidth: '25%' } },
                dataLabels: { enabled: false },
                colors: ['#4F46E5'], // Indigo-600 to match Flowbite aesthetics
                xaxis: {
                    categories: [],
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: { style: { colors: '#9CA3AF', fontSize: '10px', fontWeight: 600 } }
                },
                yaxis: { labels: { style: { colors: '#9CA3AF', fontSize: '12px' } } },
                grid: { borderColor: '#F3F4F6', strokeDashArray: 0, yaxis: { lines: { show: true } } }
            };

            const chart = new ApexCharts(document.querySelector("#activity-chart"), options);
            chart.render();

            function refreshChart() {
                updatePeriodLabel();
                const newData = generateDummyData(currentMode, periodOffset);
                chart.updateSeries([{ name: 'Aktivitas', data: newData.data }]);
                chart.updateOptions({ xaxis: { categories: newData.categories } });
            }

            document.getElementById('activity-filter').addEventListener('change', function(e) {
                currentMode = e.target.value;
                periodOffset = 0;
                refreshChart();
            });

            document.getElementById('prev-period').addEventListener('click', function() {
                periodOffset--;
                refreshChart();
            });

            document.getElementById('next-period').addEventListener('click', function() {
                if (periodOffset < 0) {
                    periodOffset++;
                    refreshChart();
                }
            });

            refreshChart();
            
            // Trash Items Date Filter Logic
            const trashDateFilter = document.getElementById('trash-date-filter');
            
            // Set default date to today
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            trashDateFilter.value = `${yyyy}-${mm}-${dd}`;

            function animateValue(obj, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            trashDateFilter.addEventListener('change', function(e) {
                const selectedDateStr = e.target.value;
                if (!selectedDateStr) return;
                
                const selectedDate = new Date(selectedDateStr);
                const isFuture = selectedDate > new Date();

                const trashCounts = document.querySelectorAll('.trash-count');
                
                trashCounts.forEach(el => {
                    const currentVal = parseInt(el.innerText);
                    let targetVal = 0;

                    if (!isFuture) {
                        const seed = selectedDate.getTime();
                        const base = parseInt(el.getAttribute('data-base'));
                        const x = Math.sin(seed + base) * 10000;
                        const randomMultiplier = ((x - Math.floor(x)) * 1.2) + 0.3;
                        targetVal = Math.floor(base * randomMultiplier) + Math.floor((x - Math.floor(x)) * 5);
                    }
                    
                    animateValue(el, currentVal, targetVal, 500);
                });
            });
        });
    </script>
</body>
</html>
