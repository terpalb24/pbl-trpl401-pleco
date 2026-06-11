<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Edit Pengguna | PLECO</title>

    <link class="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-white">
    <x-navbar.loggedin></x-navbar.loggedin>

    <div class="flex pt-16 overflow-hidden bg-white">
        <x-sidebar-operator></x-sidebar-operator>

        <div id="main-content" class="relative w-full h-[calc(100vh-4rem)] overflow-y-auto lg:ml-64 bg-slate-50/50">
            <main class="p-8 h-full">
                
                <div class="mb-8">
                    <h2 class="font-bold text-slate-800 text-2xl tracking-tight">Edit Pengguna</h2>
                    <p class="text-slate-500 text-sm mt-1">Perbarui detail informasi akun pengguna</p>
                </div>

                <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.04)] border border-slate-100 p-10 w-full min-h-[calc(100vh-14rem)] flex flex-col items-start">
                    
                    <!-- Form Fields -->
                    <form id="edit-account-form" method="POST" action="{{ route('accounts.updateUser', $account) }}" class="w-full">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                            
                            <!-- Baris 1: Nama Lengkap -->
                            <div>
                                <label for="full_name" class="block mb-2 text-sm font-medium text-slate-700">Nama Lengkap</label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $account->full_name) }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none" required>
                                @error('full_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 1: Alamat Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-slate-700">Alamat Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $account->email) }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none" required>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 1: Status Role (Sistem) -->
                            <div>
                                <label for="role" class="block mb-2 text-sm font-medium text-slate-700">Status Role <span class="text-slate-400 font-normal">(Sistem)</span></label>
                                <select id="role" name="role" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none cursor-pointer" required>
                                    <option value="OPERATOR" {{ old('role', $account->role) === 'OPERATOR' ? 'selected' : '' }}>Operator</option>
                                    <option value="ADMIN" {{ old('role', $account->role) === 'ADMIN' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 2: Kata Sandi (Spans 2 columns on desktop) -->
                            <div class="md:col-span-2">
                                <label for="password" class="block mb-2 text-sm font-medium text-slate-700">Kata Sandi Baru <span class="text-slate-400 font-normal">(opsional)</span></label>
                                <input type="password" id="password" name="password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors outline-none" placeholder="••••••••">
                                <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah kata sandi.</p>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Baris 2: Simpan Button -->
                            <div>
                                <button type="submit" class="w-full text-white bg-[#2F27CE] hover:bg-[#1c159e] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center shadow-sm transition-all hover:shadow-md h-[42px] cursor-pointer">Simpan</button>
                            </div>

                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('edit-account-form');
            if (form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Simpan Perubahan?',
                        text: 'Apakah Anda yakin ingin menyimpan perubahan data akun ini?',
                        icon: 'question',
                        iconColor: '#2F27CE',
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: 'Ya, Simpan',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-3xl border border-slate-100 p-6 shadow-2xl font-sans',
                            title: 'text-xl font-bold text-slate-800',
                            htmlContainer: 'text-sm text-slate-500 mt-2',
                            confirmButton: 'px-5 py-2.5 rounded-xl text-white bg-[#2F27CE] hover:bg-[#1c159e] font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-blue-500/20 cursor-pointer mx-2 shadow-sm',
                            cancelButton: 'px-5 py-2.5 rounded-xl text-slate-600 bg-slate-100 hover:bg-slate-200 font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-slate-500/20 cursor-pointer mx-2 shadow-sm'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
