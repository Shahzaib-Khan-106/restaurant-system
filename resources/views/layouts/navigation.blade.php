<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('restaurants.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('restaurants.index')" :active="request()->routeIs('restaurants.index')">
                        {{ __('Restaurants') }}
                    </x-nav-link>
                    <x-nav-link :href="route('restaurants.menu_items.index', 1)" :active="request()->routeIs('restaurants.menu_items.*')">
                        {{ __('Menu Items') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('restaurants.index')" :active="request()->routeIs('restaurants.index')">
                {{ __('Restaurants') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('restaurants.menu_items.index', 1)" :active="request()->routeIs('restaurants.menu_items.*')">
                {{ __('Menu Items') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
