<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Dasbor | PLECO</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <x-navbar-admin></x-navbar-admin>

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar></x-sidebar>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900 min-h-screen">
            <main class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dasbor</h1>
                <p class="mt-4 text-gray-600 dark:text-gray-400">Selamat datang di panel admin. Gunakan menu di sidebar untuk navigasi.</p>
            </main>
        </div>
    </div>
</body>
</html>
