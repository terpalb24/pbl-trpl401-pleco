<div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.09)] border border-slate-100 p-8">
    <p id="loading-text">Sedang mengambil data aktivitas...</p>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h3 class="font-bold text-slate-800 text-xl tracking-tight">Aktivitas</h3>

        <div class="flex items-center space-x-2">
            <button id="prev-period" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-100 transition" title="Sebelumnya">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <div class="flex flex-col items-center">
                <select id="period" class="bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm font-medium focus:ring-blue-500 focus:border-blue-500 pl-3 pr-7 py-2 cursor-pointer shadow-sm">
                    <option value="h" selected>Harian</option>
                    <option value="b">Bulanan</option>
                    <option value="t">Tahunan</option>
                </select>
                <span id="period-label" class="text-xs text-slate-500 mt-1 font-medium"></span>
            </div>

            <button id="next-period" class="p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-100 transition disabled:opacity-50 disabled:cursor-not-allowed" title="Selanjutnya">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
    <canvas id="myChart"></canvas>
</div>

<script src="{{ @asset('graph/chart.umd.min.js') }}"></script>
<script src="{{ @asset('graph/index.js') }}" defer></script>
