<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Masuk Akun | PLECO</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
</head>
<!-- Tampilan sementara -->
<body class="flex flex-col min-h-screen bg-[url('http://localhost:8000/images/background.png')] bg-cover bg-center">
    <x-navbar.index></x-navbar.index>

    <main class="flex flex-row min-h-screen justify-center items-center p-6">
        <form action="{{ route('login.store') }}" method="post">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                <legend class="fieldset-legend">Login</legend>

                <label class="label">Email</label>
                <input class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" />

                <label class="label">Password</label>
                <input class="input" type="password" name="password" placeholder="Kata Sandi" />

                @if($errors->any())
                    <p class="text-center text-red-600">
                        {{ $errors->first() }}
                    </p>
                @endif

                <button class="btn btn-neutral mt-4">Login</button>
            </fieldset>
        </form>
    </main>
</body>
</html>
