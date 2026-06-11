<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Sandi</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-pleco-gradient figma-black">
    <main class="flex flex-row min-h-screen justify-center items-center p-6">
        <form action="{{ route('forgot-password.password-update') }}" method="post"
            class="max-w-[350px] flex flex-col gap-5">
            <div class="mb-6">
                <a href="{{ route('forgot-password') }}" class="flex items-center gap-[8px]">
                    <x-lucide-chevron-left class="size-6" />
                    <span>Kembali</span>
                </a>
                <div class="mt-15">
                    <h1 class="text-2xl font-bold mb-2.5">Atur Ulang Sandi</h1>
                    <p class="text-[#606060] text-sm">Kata sandi harus memiliki minimal 8 karakter yang menggabungkan
                        huruf kapital, huruf kecil, angka, dan simbol.</p>
                </div>
            </div>


            @if($errors->any())
                <x-alert.danger pesan="{{ $errors->first() }}" />
            @endif

            @csrf

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

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <button
                class="bg-[#2F27CE] w-full p-3 rounded-xl text-white font-semibold cursor-pointer transition-opacity duration-75 active:opacity-80">
                Konfirmasi
            </button>
        </form>
    </main>

    @vite(['resources/js/password-ui.js'])
</body>

</html>