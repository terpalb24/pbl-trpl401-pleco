<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Dasbor | PLECO</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex flex-col">
    <x-navbar.loggedin></x-navbar.loggedin>

    <main class="flex items-center justify-center p-6">
        <h1>Dasbor</h1>
    </main>
</body>
</html>
