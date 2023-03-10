@php
    $searchBar = $searchBar ?? true;
@endphp
<x-layouts.master class="h-full bg-gray-100" >
    <div class="h-[640px] overflow-y-auto bg-gray-100">
        <div
            x-data="{ open: false }"
            x-on:keydown.window.escape="open = false"
            class="min-h-full"
        >
            {{-- Off-canvas menu for mobile, show/hide based on off-canvas menu state." --}}
            <div
                x-show="open"
                class="relative z-40 lg:hidden"
                x-ref="dialog"
                aria-modal="true"
            >
                {{-- Off-canvas menu backdrop, show/hide based on off-canvas menu state. --}}
                <div
                    x-show="open"
                    x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-600 bg-opacity-75"
                ></div>
    
                <div class="fixed inset-0 z-40 flex">
                    {{-- Off-canvas menu, show/hide based on off-canvas menu state. --}}
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full"
                        class="relative flex w-full max-w-xs flex-1 flex-col bg-deep-dark pt-5 pb-4"
                        x-on:click.away="open = false"
                    >
                        {{-- Close button, show/hide based on off-canvas menu state. --}}
                        <div
                            x-show="open"
                            x-transition:enter="ease-in-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in-out duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute top-0 right-0 -mr-12 pt-2"
                        >
                            <button
                                type="button"
                                class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                x-on:click="open = false"
                            >
                                <span class="sr-only">Close sidebar</span>
                                {{-- Heroicon name: outline/x-mark" --}}
                                <svg
                                    class="h-6 w-6 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    ></path>
                                </svg>
                            </button>
                        </div>
    
                        <a href="{{route('home')}}" class="flex flex-shrink-0 items-center px-4">
                            <x-logo-horizontal class="h-9 w-auto text-turquoise hover:text-turquoise-light transition-colors duration-700" text-color="text-cyan-50" />
                        </a>
                        <nav
                            class="mt-7 h-full flex flex-col flex-shrink-0 gap-3 overflow-y-auto"
                            aria-label="Sidebar"
                        >
                            <x-side-bar.button href="{{ route('home') }}">
                                <x-icons.home-outline class="mr-4 h-6 w-6 flex-shrink-0 text-turquoise" />
                                Transactions
                            </x-side-bar.button>
                            <x-side-bar.button href="/settings" class="text-sm">
                                <x-icons.cog-outline class="mr-4 h-6 w-6 text-turquoise" />
                                Settings
                            </x-side-bar.button>
                            {{-- <div class="px-2">
                                <a
                                    href="#"
                                    class="group flex items-center rounded-md px-2 py-2 text-base font-medium text-white text-opacity-80 hover:bg-deep-dark hover:bg-opacity-30 hover:text-opacity-100"
                                >
                                    {{-- Heroicon name: outline/cog -- }}
                                    <svg
                                        class="mr-4 h-6 w-6 text-turquoise"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"
                                        ></path>
                                    </svg>
                                    Settings
                                </a>
                            </div> --}}
                        </nav>
                    </div>
    
                    <div class="w-14 flex-shrink-0" aria-hidden="true">
                        <!-- Dummy element to force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </div>
    
            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div
                    class="flex flex-grow flex-col overflow-y-auto bg-deep-dark pt-5 pb-4"
                >
                    <a  class="flex flex-shrink-0 items-center px-4">
                        <x-logo-horizontal class="h-14 w-auto text-turquoise hover:text-turquoise-light transition-colors duration-700" text-color="text-cyan-50" />
                    </a>
                    <nav class="mt-5 flex flex-1 flex-col gap-3 overflow-y-auto" aria-label="Sidebar" >
                        <x-side-bar.button href="{{route('home')}}" class="text-sm">
                            <x-icons.home-outline class="mr-4 h-6 w-6 flex-shrink-0 text-turquoise" />
                            Transactions
                        </x-side-bar.button>
                        <x-side-bar.button href="/settings" class="text-sm">
                            <x-icons.cog-outline class="mr-4 h-6 w-6 text-turquoise" />
                            Settings
                        </x-side-bar.button>
                    </nav>
                </div>
            </div>
    
            <div class="flex flex-1 flex-col lg:pl-64">
                <div
                    class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none"
                >
                    <button
                        type="button"
                        class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-deep lg:hidden"
                        x-on:click="open = true"
                    >
                        <span class="sr-only">Open sidebar</span>
                        {{-- Heroicon name: outline/bars-3-center-left --}}
                        <svg
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5"
                            ></path>
                        </svg>
                    </button>
                    <!-- Search bar -->
                    <div
                        class="flex flex-1 justify-between px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8"
                    >
                        @if($searchBar)
                            <div class="flex flex-1">
                                <livewire:dashboard.search-bar event-name="search" placeholder="Search operations/transactions" />
                            </div>
                        @else
                            <div class="flex flex-1">
                            </div>
                        @endif
                        
                        <div class="ml-4 flex items-center md:ml-6">
                                
                            <!-- Profile dropdown -->
                            <div
                                x-data="Components.menu({ open: false })"
                                x-init="init()"
                                x-on:keydown.escape.stop="open = false; focusButton()"
                                x-on:click.away="onClickAway($event)"
                                class="relative ml-3"
                            >
                                <div>
                                    <button
                                        type="button"
                                        class="flex max-w-xs items-center rounded-sm bg-white text-sm focus:outline-none focus:ring-1 focus:ring-gray-200 focus:ring-offset-1 lg:p-2 hover:bg-gray-50"
                                        id="user-menu-button"
                                        x-ref="button"
                                        x-on:click="onButtonClick()"
                                        x-on:keyup.space.prevent="onButtonEnter()"
                                        x-on:keydown.enter.prevent="onButtonEnter()"
                                        aria-expanded="false"
                                        aria-haspopup="true"
                                        x-bind:aria-expanded="open.toString()"
                                        x-on:keydown.arrow-up.prevent="onArrowUp()"
                                        x-on:keydown.arrow-down.prevent="onArrowDown()"
                                    >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            src="{{$user->gravatar}}"
                                            alt=""
                                        />
                                        <span
                                            class="ml-3 hidden text-sm font-medium text-gray-500 lg:block"
                                            ><span class="sr-only"
                                                >Open user menu for </span
                                            >{{ $user->name }}</span
                                        >
                                        {{-- Heroicon name: mini/chevron-down --}}
                                        <svg
                                            class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Dropdown menu, show/hide based on menu state. --}}
                                <div
                                    x-cloak
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-sm bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    x-ref="menu-items"
                                    x-bind:aria-activedescendant="activeDescendant"
                                    role="menu"
                                    aria-orientation="vertical"
                                    aria-labelledby="user-menu-button"
                                    tabindex="-1"
                                    x-on:keydown.arrow-up.prevent="onArrowUp()"
                                    x-on:keydown.arrow-down.prevent="onArrowDown()"
                                    x-on:keydown.tab="open = false"
                                    x-on:keydown.enter.prevent="open = false; focusButton()"
                                    x-on:keyup.space.prevent="open = false; focusButton()"
                                >
    
                                    <a
                                        href="{{ route('user.logout') }}"
                                        class="block px-4 py-2 text-sm text-gray-700"
                                        x-bind:class="{ 'bg-gray-50': activeIndex === 0 }"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="user-menu-item-0"
                                        x-on:mouseenter="activeIndex = 0"
                                        x-on:mouseleave="activeIndex = -1"
                                        x-on:click="open = false; focusButton()"
                                        >Logout</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>    
</x-layouts.master>