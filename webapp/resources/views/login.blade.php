<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Selamat datang kembali | PLECO</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-pleco-gradient figma-black">

    <main class="flex flex-row min-h-screen justify-center items-center p-6">
        <form action="{{ route('login.store') }}" method="post" class="max-w-[350px] flex flex-col gap-5">
            <div class="text-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('images/logo2.png') }}" alt="" class="block mx-auto object-fit size-22">
                </a>
                <div class="mt-5">
                    <h1 class="text-2xl font-bold mb-2.5">Selamat Datang Kembali</h1>
                    <p class="text-[#606060] text-sm">Silakan masuk ke dalam akun Anda untuk mengelola aktivitas operasi
                        P.L.E.C.O.</p>
                </div>
            </div>

            @if(session('status'))
                <x-alert.success pesan="{{ session('status') }}" />
            @endif

            @if($errors->any())
                <x-alert.danger pesan="{{ $errors->first() }}" />
            @endif

            @csrf
            <div class="relative group transition-colors">
                <x-lucide-mail
                    class="size-5 absolute z-10 text-[#AEAEAE] group-focus-within:text-[#443DFF] top-3.75 left-3" />
                <input
                    class="p-3 pl-11 w-full placeholder:text-[#AEAEAE] border-2 border-transparent outline-none focus:border-[#443DFF] rounded-xl"
                    type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
            </div>

            <div class="relative group transition-colors">
                <x-lucide-lock-keyhole-open
                    class="size-5 absolute z-10 text-[#AEAEAE] group-focus-within:text-[#443DFF] top-3.75 left-3" />
                <input id="password-input"
                    class="p-3 pl-11 pr-12 w-full placeholder:text-[#AEAEAE] border-2 border-transparent outline-none focus:border-[#443DFF] rounded-xl"
                    type="password" name="password" placeholder="Kata Sandi" />
                <button type="button" onclick="showPassword()"
                    class="cursor-pointer absolute right-4 top-4.5 z-10 text-[#AEAEAE] group-focus-within:text-[#443DFF]">
                    <x-lucide-eye-closed id="eye-close-btn" class="size-4.5" />
                    <x-lucide-eye id="eye-open-btn" class="size-4.5 hidden" />
                </button>
            </div>

            <a href="{{ route('forgot-password') }}"
                class="text-sm text-right block self-end hover:underline text-[#443DFF]">Ubah kata sandi?</a>

            <button
                class="bg-[#2F27CE] w-full p-3 rounded-xl text-white font-semibold cursor-pointer transition-opacity duration-75 active:opacity-80">
                Masuk
            </button>

            <span class="block text-sm mt-8 text-center">Kendala masuk? <a
                    href="https://wa.me/6281374538250?text={{ urlencode('Halo Admin, saya ingin bertanya tentang produk ini.') }}"
                    target="_blank" class="text-[#443DFF] hover:underline">Hubungi administrator kami</a></span>
        </form>
    </main>

    @vite(['resources/js/password-ui.js'])
</body>

</html>