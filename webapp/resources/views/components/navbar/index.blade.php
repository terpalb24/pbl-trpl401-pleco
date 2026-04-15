<div class="navbar bg-neutral text-neutral-content shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
            </div>

            <ul
                tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li><a href="{{ route('login') }}">Masuk Akun</a></li>
            </ul>
        </div>
        <a class="btn btn-neutral text-xl">
            <img src="{{ asset('images/logo_text.png') }}" alt="Logo PLECO" class="h-8">
        </a>
    </div>

    <div class="navbar-end hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('login') }}">Masuk Akun</a></li>
        </ul>
    </div>
</div>
