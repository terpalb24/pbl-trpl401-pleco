<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>PLECO WebApp</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex flex-col bg-[url('http://localhost:8000/images/background.png')] bg-cover bg-center">
    <x-navbar.index></x-navbar.index>

    <main class="flex items-center justify-center p-6">
        <div>
            <h1 class="text-4xl font-bold">PLECO WebApp</h1>
            <p class="text-xl">Kelola data sampah dan robot PLECO Anda dengan mudah.</p>
        </div>
        <div>
            <img src="{{ @asset('images/logo.png') }}">
        </div>
    </main>
</body>
</html>
