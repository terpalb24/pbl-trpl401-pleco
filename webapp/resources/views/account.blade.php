<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Pengaturan Akun</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-wave-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(at 0% 0%, hsla(215,98%,61%,0.08) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, hsla(199,89%,48%,0.08) 0px, transparent 50%);
        }
    </style>
</head>
<body class="bg-white">
    <x-navbar.loggedin></x-navbar.loggedin>

    <div class="flex pt-16 overflow-hidden bg-white">
        <x-sidebar-operator></x-sidebar-operator>

        <div id="main-content" class="relative w-full h-[calc(100vh-4rem)] overflow-hidden lg:ml-64 bg-slate-50/50">
            <main class="p-8 h-full">
                
                <div class="mb-8">
                    <h2 class="font-bold text-slate-800 text-2xl tracking-tight">Pengaturan Akun</h2>
                    <p class="text-slate-500 text-sm mt-1">Perbarui detail profil dan kata sandi Anda di sini.</p>
                </div>

                <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.04)] border border-slate-100 p-10 w-full min-h-[calc(100vh-14rem)]">
                    @if (session('status') === 'account-updated')
                        <div class="mb-6 p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200">
                            Berhasil memperbarui informasi akun.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('account.update') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                        @csrf
                        @method('put')

                        <!-- Baris 1 -->
                        <div class="mb-10 mt-9">
                            <label for="full_name" class="block mb-2 text-sm font-medium text-slate-700">Nama Lengkap</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors" required>
                            @error('full_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-10">
                            <label for="email" class="block mb-2 text-sm font-medium text-slate-700">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors" required>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-10">
                            <label for="role" class="block mb-2 text-sm font-medium text-slate-700">Status Role <span class="text-slate-400 font-normal">(Sistem)</span></label>
                            <div class="relative">
                                <input type="text" id="role" value="{{ ucfirst($user->role) }}" class="bg-slate-100 border border-slate-200 text-slate-500 text-sm font-semibold rounded-lg block w-full p-2.5 cursor-not-allowed uppercase" disabled>
                                <svg class="w-5 h-5 absolute right-3 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                  <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Baris 2 -->
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-slate-700">Kata Sandi Baru <span class="text-slate-400 font-normal">(opsional)</span></label>
                            <input type="password" id="password" name="password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors" placeholder="••••••••">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-slate-700">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors" placeholder="••••••••">
                        </div>

                        <div>
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center shadow-sm transition-all hover:shadow-md h-[42px]">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
</body>
</html>
