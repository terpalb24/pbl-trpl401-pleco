<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Terkirim</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-pleco-gradient figma-black">
    <main class="flex flex-row min-h-screen justify-center items-center p-6">
        <div class="max-w-[400px] flex flex-col gap-5 text-center">

            <div class="bg-[#443DFF] mx-auto rounded-xl flex items-center justify-center size-20">
                <x-lucide-mail-check class="text-white size-9.5" />
            </div>

            <h1 class="font-semibold text-2xl">Periksa Inbox Email Anda</h1>
            <p class="text-[#606060]">
                Kami telah mengirimkan email ke <b>{{ $email }}</b> Tautan ini akan segera kedaluwarsa dalam 1
                menit,
                jadi silakan lakukan verifikasi sekarang.
            </p>

            <form action="{{ route('forgot-password.resend') }}" method="post" class="mt-[40px]">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <button type="submit"
                    class="bg-[#2F27CE] rounded-lg transition-opacity duration-75 active:opacity-80 text-white font-medium cursor-pointer px-[18px] py-[10px]">
                    Kirim Ulang
                </button>
            </form>

            <a href="{{ route('login') }}" class="text-sm text-[#443DFF] underline">
                Kembali ke Halaman Login
            </a>
        </div>
    </main>
</body>

</html>