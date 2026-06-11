<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gradient-to-b from-cyan-400 to-blue-600 border-r border-blue-500 sm:translate-x-0 shadow-[4px_0_24px_rgba(0,0,0,0.1)]" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-transparent">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg group transition-all {{ request()->routeIs('dashboard') ? 'bg-white/20 backdrop-blur-sm shadow-sm border border-white/10 text-white font-semibold' : 'text-white/90 hover:bg-white/10 hover:text-white font-medium' }}">
               <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-white/70 group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3 tracking-wide">Beranda</span>
            </a>
         </li>
          @if(auth()->user() && auth()->user()->role === 'ADMIN')
          <li>
             <a href="{{ route('admin.accounts.index') }}" class="flex items-center p-2 rounded-lg group transition-all {{ request()->routeIs('admin.accounts.*') || request()->routeIs('accounts.*') ? 'bg-white/20 backdrop-blur-sm shadow-sm border border-white/10 text-white font-semibold' : 'text-white/90 hover:bg-white/10 hover:text-white font-medium' }}">
                <svg class="flex-shrink-0 w-5 h-5 transition duration-75 {{ request()->routeIs('admin.accounts.*') || request()->routeIs('accounts.*') ? 'text-white' : 'text-white/70 group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                   <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                </svg>
                <span class="flex-1 ms-3 tracking-wide">Daftar Akun</span>
             </a>
          </li>
          @endif
          <li>
             <a href="{{ route('account.index') }}" class="flex items-center p-2 rounded-lg group transition-all {{ request()->routeIs('account.settings') || request()->routeIs('account.update') ? 'bg-white/20 backdrop-blur-sm shadow-sm border border-white/10 text-white font-semibold' : 'text-white/90 hover:bg-white/10 hover:text-white font-medium' }}">
                <svg class="flex-shrink-0 w-5 h-5 transition duration-75 {{ request()->routeIs('account.settings') || request()->routeIs('account.update') ? 'text-white' : 'text-white/70 group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                   <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <span class="flex-1 ms-3 tracking-wide">Akun</span>
             </a>
          </li>
      </ul>
   </div>
</aside>
