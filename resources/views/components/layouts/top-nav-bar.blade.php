<nav
    x-data="{ open: false }"
    class="border-b border-gray-200 bg-white"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex flex-shrink-0 items-center">
                    <div class="font-black text-blue-800 tracking-tight">
                        ACCOUNTABLE
                    </div>
                </a>
                
                {{-- Desktop Menu --}}
                <div class="hidden sm:-my-px sm:flex sm:ml-12 sm:space-x-8">

                    @auth
                        @foreach ($links as $route => $text)
                            <x-layouts.nav-desktop-button :route="$route" :text="$text" :current="$currentRoute($route)" />
                        @endforeach
                    @endauth

                    {{-- {{ $topbar }} --}}

                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    {{-- <x-notifications-button /> --}}

                    {{-- Profile dropdown --}}
                    <x-user.profile-dropdown />

                @endauth
                @guest
                    <a href="{{ route('user.login')}}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                        Sign in</a>
                    <a href="{{ route('user.register')}}" class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                        Sign up</a>
                @endguest
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                {{-- Mobile menu button --}}
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    aria-controls="mobile-menu"
                    x-on:click="open = !open"
                    aria-expanded="false"
                    x-bind:aria-expanded="open.toString()"
                >
                    <span class="sr-only">Open main menu</span>
                    {{-- Heroicon name: outline/bars-3 --}}
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        x-bind:class="{ 'hidden': open, 'block': !(open) }" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                    {{-- Heroicon name: outline/x-mark --}}
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        x-bind:class="{ 'block': open, 'hidden': !(open) }">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" ></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-cloak x-show="open" class="sm:hidden" id="mobile-menu"  >
        <div class="space-y-1 pt-2 pb-3">
            @auth
                @foreach ($links as $route => $text)
                    <x-layouts.nav-mobile-button :route="$route" :text="$text" :current="$currentRoute($route)" />
                @endforeach
            @endauth
            @guest
                <div class="mx-6 mt-2 mb-3">
                    <a href="{{ route('user.register')}}" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                        Sign up</a>
                    <p class="mt-6 text-center text-base font-medium text-gray-500">
                    Have an account?
                    <!-- space -->
                    <a href="{{ route('user.login')}}" class="text-indigo-600 hover:text-indigo-500">
                        Sign in</a>
                    </p>
                </div>
            @endguest

        </div>
        {{-- Profile options --}}
        @auth
            <x-user.mobile-profile-options :user="$user" />
        @endauth

    </div>
</nav>