<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>PLECO | Dasbor Admin</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet.js for GPS Live Tracking Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    <x-card.trash
                        name="Botol Mineral"
                        image_name="bottle.png"
                        :total="$bottle"
                    ></x-card.trash>
                    <x-card.trash
                        name="Kantong Plastik"
                        image_name="plastic_bag.png"
                        :total="$plastic_bag"
                    ></x-card.trash>
                    <x-card.trash
                        name="Karton Susu"
                        image_name="milk_carton.png"
                        :total="$milk_carton"
                    ></x-card.trash>
                    <x-card.trash
                        :total="$all_trash"
                    ></x-card.trash>
                </div>

                <!-- Live GPS Tracking Map -->
                <x-dashboard-map :api_key="$api_key ?? ''" :last_loc="$last_loc" />

                <!-- Stats -->
                <div class="grid grid-cols-1 gap-4">
                   <x-graph.trash></x-graph.trash>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
