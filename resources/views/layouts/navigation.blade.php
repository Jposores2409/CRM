<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/70 backdrop-blur-md border-b border-cyan-500/15">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <!-- Settings Dropdown -->
            <div class="flex items-center gap-3">

                <!-- Avatar con iniciales -->
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <!-- Botón del dropdown — estilo cian pill -->
                        <button class="inline-flex items-center gap-1.5 text-xs font-medium text-cyan-700 border border-cyan-500/30 bg-white hover:bg-cyan-50 hover:border-cyan-400 px-3 py-1.5 rounded-full transition-all duration-150 focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="w-3 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile link -->
                        <x-dropdown-link :href="route('profile.edit')"
                            class="text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 transition-colors">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                class="text-sm text-red-500 hover:text-red-600 hover:bg-red-50 transition-colors"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Hamburger (mobile) — sin cambios funcionales -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-cyan-600 hover:bg-cyan-50 focus:outline-none transition duration-150">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu (mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-cyan-500/10 bg-white/90 backdrop-blur-md">

        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-sm text-gray-600 hover:text-cyan-600">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-cyan-500/10">

            <!-- Info del usuario -->
            <div class="flex items-center gap-3 px-4 mb-3">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="font-semibold text-sm text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        class="text-sm text-red-500 hover:bg-red-50 rounded-lg"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>
    </div>

</nav>