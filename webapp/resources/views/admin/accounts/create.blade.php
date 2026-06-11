<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Tambah Pengguna | PLECO</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <x-navbar.loggedin></x-navbar.loggedin>

    <div class="flex pt-16 overflow-hidden bg-white">
        <x-sidebar-operator></x-sidebar-operator>

        <div id="main-content" class="relative w-full h-[calc(100vh-4rem)] overflow-y-auto lg:ml-64 bg-slate-50/50">
            <main class="p-8 h-full">
                
                <div class="mb-8">
                    <h2 class="font-bold text-slate-800 text-2xl tracking-tight">Tambah Pengguna</h2>
                    <p class="text-slate-500 text-sm mt-1">Tambahkan pengguna baru ke dalam website</p>
                </div>

                <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.04)] border border-slate-100 p-10 w-full min-h-[calc(100vh-14rem)] flex flex-col items-start">
                    
                    <!-- Form Fields -->
                    <form method="POST" action="{{ route('accounts.store') }}" class="w-full">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                            
                            <!-- Baris 1: Nama Lengkap -->
                            <div>
                                <label for="full_name" class="block mb-2 text-sm font-medium text-slate-700">Nama Lengkap</label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none" placeholder="Masukkan nama lengkap" required>
                                @error('full_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 1: Alamat Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-slate-700">Alamat Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none" placeholder="Masukkan alamat email" required>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 1: Status Role (Sistem) -->
                            <div>
                                <label for="role" class="block mb-2 text-sm font-medium text-slate-700">Status Role <span class="text-slate-400 font-normal">(Sistem)</span></label>
                                <select id="role" name="role" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none cursor-pointer" required>
                                    <option value="OPERATOR" {{ old('role') === 'OPERATOR' ? 'selected' : '' }}>Operator</option>
                                    <option value="ADMIN" {{ old('role') === 'ADMIN' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 2: Kata Sandi (Spans 2 columns on desktop) -->
                            <div class="md:col-span-2">
                                <label for="password" class="block mb-2 text-sm font-medium text-slate-700">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none" placeholder="••••••••" required>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 2: Tambah Button -->
                            <div>
                                <button type="submit" class="w-full text-white bg-[#2F27CE] hover:bg-[#1c159e] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center shadow-sm transition-all hover:shadow-md h-[42px] cursor-pointer">Tambah</button>
                            </div>

                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
</body>
</html>
