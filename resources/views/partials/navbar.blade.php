<nav class="bg-[#679CEB] py-3 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-white font-bold text-2xl flex items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 mr-2"> 
            Telkom Internship
        </a>

        <!-- Menu Navbar -->
        <ul class="flex items-center gap-4">
            @if(Auth::user() && Auth::user()->role == 'admin')
            <li>
                <a href="{{ route('admin.arsip') }}" 
                    class="{{ request()->routeIs('admin.arsip') ? 'text-gray-700 font-semibold' : 'text-white' }}">
                    Arsip
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('internships.index') }}" 
                    class="{{ request()->routeIs('internships.index') ? 'text-gray-700 font-semibold' : 'text-white' }}">
                   Program Magang
                </a>
            </li>

            @auth
                @if(Auth::user()->role == 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                        class="{{ request()->routeIs('admin.dashboard') ? 'text-gray-700 font-semibold' : 'text-white' }}">
                           Dashboard Admin
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'pembimbing')
                    <li>
                        <a href="{{ route('pembimbing.dashboard') }}" 
                        class="{{ request()->routeIs('pembimbing.dashboard') ? 'text-gray-700 font-semibold' : 'text-white' }}">
                           Dashboard Pembimbing
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'user')
                    <li>
                        <a href="{{ route('user.dashboard') }}" 
                            class="{{ request()->routeIs('user.dashboard') ? 'text-gray-700 font-semibold' : 'text-white' }}">
                           Dashboard User
                        </a>
                    </li>
                @endif

                <!-- Profil Dropdown -->
                <li class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-white focus:outline-none">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : asset('images/profile/default.png') }}" 
                            class="rounded-full w-8 h-8" alt="Profil">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 hidden">
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profil</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">Logout</button>
                        </form>
                    </div>
                </li>
            @else
                <!-- Button Login/Register jika belum login -->
                <li>
                    <a href="{{ route('login') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition-all duration-300">
                        Log in/Register
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<script>
    function toggleDropdown() {
        document.getElementById('profileDropdown').classList.toggle('hidden');
    }

    // Tutup dropdown jika klik di luar
    window.onclick = function(event) {
        if (!event.target.closest('button')) {
            document.getElementById('profileDropdown').classList.add('hidden');
        }
    };
</script>

@push('styles')
<style>
    .text-gray-700 {
        color: #1a202c !important;
        font-weight: 600 !important;
    }
</style>
@endpush
