<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun Anda</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-pleco-gradient figma-black">
    <main class="flex flex-row min-h-screen justify-center items-center p-6">
        <form action="{{ route('forgot-password.send-email') }}" method="post"
            class="max-w-[350px] flex flex-col gap-5">
            <div class="mb-6">
                <a href="{{ route('login') }}" class="flex items-center gap-[8px]">
                    <x-lucide-chevron-left class="size-6" />
                    <span>Kembali</span>
                </a>
                <div class="mt-15">
                    <h1 class="text-2xl font-bold mb-2.5">Verifikasi Akun Anda</h1>
                    <p class="text-[#606060] text-sm">Masukkan email Anda untuk memverifikasi identitas sebelum mengubah
                        kata sandi.</p>
                </div>
            </div>

            @if(session('status'))
                <x-alert.success pesan="{{ session('status') }}" />
            @endif

            @if($errors->any() || request()->query('email'))
                <x-alert.danger pesan="{{ $errors->any() ? $errors->first() : request()->query('email') }}" />
            @endif

            @csrf
            <div class="relative group transition-colors">
                <x-lucide-mail
                    class="size-5 absolute z-10 text-[#AEAEAE] group-focus-within:text-[#443DFF] top-3.75 left-3" />
                <input
                    class="p-3 pl-11 w-full placeholder:text-[#AEAEAE] border-2 border-transparent outline-none focus:border-[#443DFF] rounded-xl"
                    type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
            </div>

            <button
                class="bg-[#2F27CE] w-full p-3 rounded-xl text-white font-semibold cursor-pointer transition-opacity duration-75 active:opacity-80">
                Konfirmasi
            </button>
        </form>
    </main>

    @vite(['resources/js/password-ui.js'])
</body>

</html>