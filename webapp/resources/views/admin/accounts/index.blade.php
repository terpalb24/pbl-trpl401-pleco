<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Daftar Akun Pengguna</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-white">
    <x-navbar.loggedin></x-navbar.loggedin>

    <div class="flex pt-16 overflow-hidden bg-white">
        <x-sidebar-operator></x-sidebar-operator>

        <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64 bg-slate-50/50 min-h-screen">
            <main class="p-8">
                
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 mt-2 gap-4">
                    <div>
                        <h2 class="font-bold text-slate-800 text-2xl tracking-tight">Daftar Akun Pengguna</h2>
                        <p class="text-slate-500 text-sm mt-1">Semua akun pengguna saat ini di sistem</p>
                    </div>
                </div>

                <!-- Session Notifications -->
                @if (session('status') === 'account-created')
                    <div class="mb-6 p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Akun baru berhasil ditambahkan ke sistem.</span>
                    </div>
                @endif

                @if (session('status') === 'account-updated')
                    <div class="mb-6 p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Informasi akun berhasil diperbarui.</span>
                    </div>
                @endif

                @if (session('status') === 'account-deleted')
                    <div class="mb-6 p-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>Akun pengguna berhasil dihapus.</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Search & Filters Toolbar -->
                <div class="bg-white rounded-t-3xl border-t border-x border-slate-100 p-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <!-- Search Input -->
                    <form method="GET" action="{{ route('admin.accounts.index') }}" class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-11 p-3 transition-colors outline-none">
                    </form>

                    <!-- Filter and Action Buttons -->
                    <div class="flex items-center gap-4 w-full md:w-auto justify-end">
                        <!-- Bulk Delete Form & Button -->
                        <form id="bulk-delete-form" method="POST" action="{{ route('accounts.bulkDestroy') }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <div id="bulk-delete-inputs" class="hidden"></div>
                            <button type="button" id="bulk-delete-btn" class="hidden flex items-center gap-2 bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 text-sm font-semibold rounded-xl px-4 py-3 transition shadow-sm cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                <span>Hapus (<span id="selected-count">0</span>)</span>
                            </button>
                        </form>

                        <!-- Filter Dropdown -->
                        <div class="relative" id="filter-wrapper">
                            <button id="filter-btn" class="flex items-center gap-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-4 py-3 transition shadow-sm cursor-pointer">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                <span>Filter</span>
                                <svg class="w-4 h-4 text-slate-400 ms-1 transition-transform duration-200" id="filter-chevron" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                                <span id="filter-badge" class="bg-slate-400 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-bold">0</span>
                            </button>
                            <!-- Dropdown Panel -->
                            <div id="filter-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-2xl shadow-lg z-40 p-3 flex flex-col gap-1">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-1 mb-1">Tampilkan Kolom</p>
                                <label class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg hover:bg-slate-50 cursor-pointer select-none">
                                    <input type="checkbox" id="col-name" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                    <span class="text-sm text-slate-700 font-medium">Nama Lengkap</span>
                                </label>
                                <label class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg hover:bg-slate-50 cursor-pointer select-none">
                                    <input type="checkbox" id="col-email" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                    <span class="text-sm text-slate-700 font-medium">Email</span>
                                </label>
                                <label class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg hover:bg-slate-50 cursor-pointer select-none">
                                    <input type="checkbox" id="col-role" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                    <span class="text-sm text-slate-700 font-medium">Peran</span>
                                </label>
                            </div>
                        </div>

                        <!-- Add User Button -->
                        <a href="{{ route('accounts.create') }}" class="flex items-center gap-2 bg-[#443DFF] hover:bg-[#1c159e] text-white text-sm font-semibold rounded-xl px-5 py-3 shadow-sm transition hover:shadow-md cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            <span>Pengguna Baru</span>
                        </a>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-b-3xl border-b border-x border-slate-100 overflow-x-auto shadow-[0_4px_24px_rgba(0,0,0,0.02)]">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr id="table-header-row" class="border-y border-slate-100 text-slate-500 font-bold text-xs uppercase bg-slate-50/50">
                                <th class="p-5 w-12 text-center">
                                    <input type="checkbox" id="select-all-checkbox" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                </th>
                                <th data-col="name" class="p-5 font-bold tracking-wider text-slate-700 text-sm">Nama Lengkap</th>
                                <th data-col="email" class="p-5 font-bold tracking-wider text-slate-700 text-sm">Email</th>
                                <th data-col="role" class="p-5 font-bold tracking-wider text-slate-700 text-sm">Peran</th>
                                <th class="p-5 font-bold tracking-wider text-slate-700 text-sm text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100" id="accounts-table-body">
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.02)] border border-slate-100" id="pagination-footer">
                    <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
                        <span>Tampil</span>
                        <select id="per-page-select" class="bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm font-semibold focus:ring-blue-500 focus:border-blue-500 pl-3 pr-8 py-1.5 outline-none cursor-pointer">
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span>dari <span id="total-count" class="font-semibold text-slate-700">0</span> data</span>
                    </div>
                    <div id="pagination-links">
                    </div>
                </div>
            </main>
        </div>
    </div>
    @php
        $accountsJson = $accounts->map(function($account) {
            return [
                'account_id' => $account->account_id,
                'full_name' => $account->full_name,
                'email' => $account->email,
                'role' => $account->role,
                'edit_url' => route('accounts.edit', $account),
                'delete_url' => route('accounts.destroy', $account),
            ];
        })->values();
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // All accounts data embedded as JSON (loaded once, no more server requests)
            const allAccounts = @json($accountsJson);

            const colorMap = {
                'A':'bg-indigo-500','B':'bg-sky-500','C':'bg-emerald-500',
                'D':'bg-teal-500','E':'bg-cyan-500','F':'bg-violet-500',
                'G':'bg-purple-500','H':'bg-pink-500','I':'bg-rose-500',
                'J':'bg-blue-600','K':'bg-amber-500','L':'bg-orange-500',
                'M':'bg-red-500','N':'bg-emerald-600','O':'bg-indigo-600',
                'P':'bg-violet-600','Q':'bg-purple-600','R':'bg-pink-600',
                'S':'bg-rose-600','T':'bg-sky-600','U':'bg-teal-600',
                'V':'bg-cyan-600','W':'bg-amber-600','X':'bg-orange-600',
                'Y':'bg-red-600','Z':'bg-blue-500'
            };

            let currentPage = 1;
            let perPage = 10;
            let searchQuery = '';
            let visibleCols = { name: false, email: false, role: false };

            const selectedAccountIds = new Set();
            const currentUserId = "{{ auth()->user()->account_id }}";

            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            const selectedCountSpan = document.getElementById('selected-count');
            const bulkDeleteForm = document.getElementById('bulk-delete-form');
            const bulkDeleteInputs = document.getElementById('bulk-delete-inputs');

            const tbody = document.getElementById('accounts-table-body');
            const paginationLinks = document.getElementById('pagination-links');
            const totalCount = document.getElementById('total-count');
            const perPageSelect = document.getElementById('per-page-select');
            const searchInput = document.querySelector('input[name="search"]');
            const searchForm = searchInput ? searchInput.closest('form') : null;

            // Filter dropdown toggle
            const filterBtn = document.getElementById('filter-btn');
            const filterDropdown = document.getElementById('filter-dropdown');
            const filterChevron = document.getElementById('filter-chevron');
            const filterBadge = document.getElementById('filter-badge');
            const colCheckboxes = {
                name: document.getElementById('col-name'),
                email: document.getElementById('col-email'),
                role: document.getElementById('col-role'),
            };

            filterBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                filterDropdown.classList.toggle('hidden');
                filterChevron.style.transform = filterDropdown.classList.contains('hidden') ? '' : 'rotate(180deg)';
            });

            document.addEventListener('click', (e) => {
                if (!document.getElementById('filter-wrapper').contains(e.target)) {
                    filterDropdown.classList.add('hidden');
                    filterChevron.style.transform = '';
                }
            });

            function updateColumnVisibility() {
                visibleCols.name = colCheckboxes.name.checked;
                visibleCols.email = colCheckboxes.email.checked;
                visibleCols.role = colCheckboxes.role.checked;

                const checkedCount = Object.values(visibleCols).filter(Boolean).length;
                const totalCols = Object.keys(visibleCols).length;
                const showAll = checkedCount === 0 || checkedCount === totalCols;

                // Update badge
                filterBadge.textContent = checkedCount;
                filterBadge.className = checkedCount === 0
                    ? 'bg-slate-400 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-bold'
                    : 'bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-bold';

                // Show/hide header columns
                document.querySelectorAll('#table-header-row th[data-col]').forEach(th => {
                    const col = th.dataset.col;
                    th.style.display = (showAll || visibleCols[col]) ? '' : 'none';
                });

                renderTable();
            }

            Object.entries(colCheckboxes).forEach(([key, checkbox]) => {
                checkbox.addEventListener('change', updateColumnVisibility);
            });

             // Action buttons event delegation for SweetAlert2 confirmations
             tbody.addEventListener('click', (e) => {
                 const deleteBtn = e.target.closest('.delete-btn');
                 if (deleteBtn) {
                     e.preventDefault();
                     const form = deleteBtn.closest('form');
                     const name = deleteBtn.getAttribute('data-name');
                     
                      Swal.fire({
                          title: 'Hapus Akun?',
                          text: `Apakah Anda yakin ingin menghapus akun "${name}"? Tindakan ini tidak dapat dibatalkan.`,
                          icon: 'warning',
                          iconColor: '#EF4444',
                          showCancelButton: true,
                          buttonsStyling: false,
                          confirmButtonText: 'Ya, Hapus!',
                          cancelButtonText: 'Batal',
                          customClass: {
                              popup: 'rounded-3xl border border-slate-100 p-6 shadow-2xl font-sans',
                              title: 'text-xl font-bold text-slate-800',
                              htmlContainer: 'text-sm text-slate-500 mt-2',
                              confirmButton: 'px-5 py-2.5 rounded-xl text-white bg-red-600 hover:bg-red-700 font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-red-500/20 cursor-pointer mx-2 shadow-sm',
                              cancelButton: 'px-5 py-2.5 rounded-xl text-slate-600 bg-slate-100 hover:bg-slate-200 font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-slate-500/20 cursor-pointer mx-2 shadow-sm'
                          }
                      }).then((result) => {
                          if (result.isConfirmed) {
                              form.submit();
                          }
                      });
                  }
             });

             // Update Bulk Delete UI elements and hidden inputs
             function updateBulkDeleteUI() {
                 const checkedCount = selectedAccountIds.size;
                 selectedCountSpan.textContent = checkedCount;

                 if (checkedCount > 0) {
                     bulkDeleteBtn.classList.remove('hidden');
                 } else {
                     bulkDeleteBtn.classList.add('hidden');
                 }

                 // Generate hidden form inputs for submitted IDs
                 bulkDeleteInputs.innerHTML = '';
                 selectedAccountIds.forEach(id => {
                     const input = document.createElement('input');
                     input.type = 'hidden';
                     input.name = 'ids[]';
                     input.value = id;
                     bulkDeleteInputs.appendChild(input);
                 });

                 // Synchronize the header select-all checkbox
                 const rowCheckboxes = tbody.querySelectorAll('.row-checkbox');
                 if (rowCheckboxes.length > 0) {
                     const allPageChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                     selectAllCheckbox.checked = allPageChecked;
                 } else {
                     selectAllCheckbox.checked = false;
                 }
             }

             // Select All checkbox change listener
             selectAllCheckbox.addEventListener('change', () => {
                 const rowCheckboxes = tbody.querySelectorAll('.row-checkbox');
                 const isChecked = selectAllCheckbox.checked;

                 rowCheckboxes.forEach(cb => {
                     const id = cb.dataset.id;
                     cb.checked = isChecked;
                     if (isChecked) {
                         selectedAccountIds.add(id);
                     } else {
                         selectedAccountIds.delete(id);
                     }
                 });

                 updateBulkDeleteUI();
             });

             // Individual row checkbox selection tracking via change event
             tbody.addEventListener('change', (e) => {
                 const cb = e.target.closest('.row-checkbox');
                 if (cb) {
                     const id = cb.dataset.id;
                     if (cb.checked) {
                         selectedAccountIds.add(id);
                     } else {
                         selectedAccountIds.delete(id);
                     }
                     updateBulkDeleteUI();
                 }
             });

             // Bulk Delete confirmation and submit
             bulkDeleteBtn.addEventListener('click', () => {
                 const count = selectedAccountIds.size;
                 Swal.fire({
                     title: 'Hapus Semua Akun Terpilih?',
                     text: `Apakah Anda yakin ingin menghapus ${count} akun yang terpilih? Tindakan ini tidak dapat dibatalkan.`,
                     icon: 'warning',
                     iconColor: '#EF4444',
                     showCancelButton: true,
                     buttonsStyling: false,
                     confirmButtonText: 'Ya, Hapus Semua!',
                     cancelButtonText: 'Batal',
                     customClass: {
                         popup: 'rounded-3xl border border-slate-100 p-6 shadow-2xl font-sans',
                         title: 'text-xl font-bold text-slate-800',
                         htmlContainer: 'text-sm text-slate-500 mt-2',
                         confirmButton: 'px-5 py-2.5 rounded-xl text-white bg-red-600 hover:bg-red-700 font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-red-500/20 cursor-pointer mx-2 shadow-sm',
                         cancelButton: 'px-5 py-2.5 rounded-xl text-slate-600 bg-slate-100 hover:bg-slate-200 font-semibold text-sm transition-all focus:outline-none focus:ring-4 focus:ring-slate-500/20 cursor-pointer mx-2 shadow-sm'
                     }
                 }).then((result) => {
                     if (result.isConfirmed) {
                         bulkDeleteForm.submit();
                     }
                 });
             });

            function getInitials(name) {
                const words = name.split(' ');
                let initials = '';
                for (const w of words) {
                    initials += w.charAt(0);
                    if (initials.length >= 2) break;
                }
                return initials.toUpperCase();
            }

            function getColor(initials) {
                const firstLetter = initials.charAt(0);
                return colorMap[firstLetter] || 'bg-indigo-500';
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function getFilteredAccounts() {
                if (!searchQuery) return allAccounts;
                const q = searchQuery.toLowerCase();
                return allAccounts.filter(a => 
                    a.full_name.toLowerCase().includes(q) || 
                    a.email.toLowerCase().includes(q)
                );
            }

            function renderTable() {
                const filtered = getFilteredAccounts();
                const total = filtered.length;
                const totalPages = Math.max(1, Math.ceil(total / perPage));

                // Clamp current page
                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const startIdx = (currentPage - 1) * perPage;
                const pageData = filtered.slice(startIdx, startIdx + perPage);

                // Effective visibility: none checked OR all checked → show all
                const checkedCount = Object.values(visibleCols).filter(Boolean).length;
                const totalColCount = Object.keys(visibleCols).length;
                const showAll = checkedCount === 0 || checkedCount === totalColCount;
                const eff = {
                    name:  showAll || visibleCols.name,
                    email: showAll || visibleCols.email,
                    role:  showAll || visibleCols.role,
                };

                // Update total count
                totalCount.textContent = total;

                // Render rows
                let html = '';
                for (const account of pageData) {
                    const initials = getInitials(account.full_name);
                    const bgColor = getColor(initials);
                    const safeName = escapeHtml(account.full_name);
                    const safeEmail = escapeHtml(account.email);

                    const roleBadge = account.role === 'ADMIN'
                        ? `<span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-[#D97706] bg-[#FEF3C7] border border-[#D97706] rounded-lg uppercase tracking-wide">Admin</span>`
                        : `<span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-blue-600 bg-[#E0E7FF] border border-blue-600 rounded-lg uppercase tracking-wide">Operator</span>`;

                    const nameTd = eff.name ? `
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full ${bgColor} flex items-center justify-center font-bold text-white shadow-sm">${initials}</div>
                                <span class="font-semibold text-slate-800 text-sm">${safeName}</span>
                            </div>
                        </td>` : '';

                    const emailTd = eff.email
                        ? `<td class="p-5 text-sm text-slate-600">${safeEmail}</td>` : '';

                    const roleTd = eff.role
                        ? `<td class="p-5 text-sm">${roleBadge}</td>` : '';

                    const isChecked = selectedAccountIds.has(account.account_id) ? 'checked' : '';
                    const isSelf = account.account_id === currentUserId;

                    const checkboxHtml = isSelf
                        ? `<input type="checkbox" class="w-4 h-4 text-slate-300 border-slate-200 rounded cursor-not-allowed bg-slate-100" disabled title="Anda tidak dapat menghapus akun sendiri">`
                        : `<input type="checkbox" class="row-checkbox w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer" data-id="${account.account_id}" ${isChecked}>`;

                    const deleteBtnHtml = isSelf
                        ? `<button type="button" class="text-slate-300 p-1.5 rounded-lg cursor-not-allowed" disabled title="Anda tidak dapat menghapus akun sendiri">
                               <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                           </button>`
                        : `<form method="POST" action="${account.delete_url}" class="inline delete-form">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <input type="hidden" name="_method" value="DELETE">
                               <button type="button" class="text-slate-500 hover:text-red-600 p-1.5 rounded-lg hover:bg-slate-100 transition duration-200 cursor-pointer delete-btn" data-name="${safeName}" title="Hapus">
                                   <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                               </button>
                           </form>`;

                    html += `
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-5 text-center">
                            ${checkboxHtml}
                        </td>
                        ${nameTd}
                        ${emailTd}
                        ${roleTd}
                        <td class="p-5 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="${account.edit_url}" class="text-slate-500 hover:text-[#2F27CE] p-1.5 rounded-lg hover:bg-slate-100 transition duration-200" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                ${deleteBtnHtml}
                            </div>
                        </td>
                    </tr>`;
                }
                tbody.innerHTML = html;
                updateBulkDeleteUI();

                // Render pagination
                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                if (totalPages <= 0) {
                    paginationLinks.innerHTML = '';
                    return;
                }

                const btnBase = 'w-9 h-9 flex items-center justify-center rounded-xl select-none transition text-sm';
                const btnDisabled = `${btnBase} bg-slate-50 text-slate-400 cursor-not-allowed`;
                const btnEnabled = `${btnBase} bg-slate-50 text-slate-600 hover:bg-slate-100 cursor-pointer`;
                const btnActive = `${btnBase} bg-[#443DFF] text-white font-semibold shadow-sm`;
                const btnPage = `${btnBase} bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 cursor-pointer font-medium`;

                let html = '<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-2">';

                // Previous
                const prevSvg = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>';
                if (currentPage <= 1) {
                    html += `<span class="${btnDisabled}">${prevSvg}</span>`;
                } else {
                    html += `<a href="#" data-page="${currentPage - 1}" class="${btnEnabled}">${prevSvg}</a>`;
                }

                // Page numbers with ellipsis
                const pages = generatePageNumbers(currentPage, totalPages);
                for (const p of pages) {
                    if (p === '...') {
                        html += '<span class="px-2 text-slate-400 font-medium select-none">...</span>';
                    } else if (p === currentPage) {
                        html += `<span class="${btnActive}">${p}</span>`;
                    } else {
                        html += `<a href="#" data-page="${p}" class="${btnPage}">${p}</a>`;
                    }
                }

                // Next
                const nextSvg = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>';
                if (currentPage >= totalPages) {
                    html += `<span class="${btnDisabled}">${nextSvg}</span>`;
                } else {
                    html += `<a href="#" data-page="${currentPage + 1}" class="${btnEnabled}">${nextSvg}</a>`;
                }

                html += '</nav>';
                paginationLinks.innerHTML = html;
            }

            function generatePageNumbers(current, total) {
                if (total <= 7) {
                    return Array.from({length: total}, (_, i) => i + 1);
                }
                const pages = [];
                pages.push(1);
                if (current > 3) pages.push('...');
                for (let i = Math.max(2, current - 1); i <= Math.min(total - 1, current + 1); i++) {
                    pages.push(i);
                }
                if (current < total - 2) pages.push('...');
                pages.push(total);
                return pages;
            }

            // Event: pagination link clicks
            paginationLinks.addEventListener('click', (e) => {
                const link = e.target.closest('a[data-page]');
                if (link) {
                    e.preventDefault();
                    currentPage = parseInt(link.dataset.page);
                    renderTable();
                }
            });

            // Event: per-page select change
            perPageSelect.addEventListener('change', () => {
                perPage = parseInt(perPageSelect.value);
                currentPage = 1;
                renderTable();
            });

            // Event: search input
            if (searchInput && searchForm) {
                searchForm.addEventListener('submit', (e) => e.preventDefault());
                searchInput.addEventListener('input', () => {
                    searchQuery = searchInput.value.trim();
                    currentPage = 1;
                    renderTable();
                });
            }

            // Initial render
            renderTable();
        });
    </script>
</body>
</html>

