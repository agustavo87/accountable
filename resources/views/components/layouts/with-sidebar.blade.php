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
            <div
                x-show="open"
                class="relative z-40 lg:hidden"
                x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state."
                x-ref="dialog"
                aria-modal="true"
            >
                <div
                    x-show="open"
                    x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state."
                    class="fixed inset-0 bg-gray-600 bg-opacity-75"
                ></div>
    
                <div class="fixed inset-0 z-40 flex">
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full"
                        x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                        class="relative flex w-full max-w-xs flex-1 flex-col bg-cyan-700 pt-5 pb-4"
                        x-on:click.away="open = false"
                    >
                        <div
                            x-show="open"
                            x-transition:enter="ease-in-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in-out duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            x-description="Close button, show/hide based on off-canvas menu state."
                            class="absolute top-0 right-0 -mr-12 pt-2"
                        >
                            <button
                                type="button"
                                class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                x-on:click="open = false"
                            >
                                <span class="sr-only">Close sidebar</span>
                                <svg
                                    class="h-6 w-6 text-white"
                                    x-description="Heroicon name: outline/x-mark"
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
    
                        <div class="flex flex-shrink-0 items-center px-4">
                            <x-logo-horizontal class="h-14 text-cyan-400 w-auto" text-color="text-cyan-100" />
                        </div>
                        <nav
                            class="mt-5 h-full flex-shrink-0 divide-y divide-cyan-800 overflow-y-auto"
                            aria-label="Sidebar"
                        >
                            <div class="space-y-1 px-2">
                                <a
                                    href="{{ route('home') }}"
                                    class="bg-cyan-800 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    x-state:on="Current"
                                    x-state:off="Default"
                                    aria-current="page"
                                    x-state-description='Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                        x-description="Heroicon name: outline/home"
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
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                        ></path>
                                    </svg>
                                    Transactions
                                </a>
                            </div>
                            <div class="mt-6 pt-6">
                                <div class="space-y-1 px-2">
                                    <a
                                        href="#"
                                        class="group flex items-center rounded-md px-2 py-2 text-base font-medium text-cyan-100 hover:bg-cyan-600 hover:text-white"
                                    >
                                        <svg
                                            class="mr-4 h-6 w-6 text-cyan-200"
                                            x-description="Heroicon name: outline/cog"
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
                                </div>
                            </div>
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
                    class="flex flex-grow flex-col overflow-y-auto bg-cyan-700 pt-5 pb-4"
                >
                    <div class="flex flex-shrink-0 items-center px-4">
                        <x-logo-horizontal class="h-14 text-cyan-400 w-auto" text-color="text-cyan-100" />
                    </div>
                    <nav
                        class="mt-5 flex flex-1 flex-col divide-y divide-cyan-800 overflow-y-auto"
                        aria-label="Sidebar"
                    >
                        <div class="space-y-1 px-2">
                            <a
                                href="{{ route('home') }}"
                                class="bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                x-state:on="Current"
                                x-state:off="Default"
                                aria-current="page"
                                x-state-description='Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                            >
                                <svg
                                    class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                    x-description="Heroicon name: outline/home"
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
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                    ></path>
                                </svg>
                                Transactions
                            </a>
                        </div>
                        <div class="mt-6 pt-6">
                            <div class="space-y-1 px-2">
                                <a
                                    href="#"
                                    class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-cyan-100 hover:bg-cyan-600 hover:text-white"
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 text-cyan-200"
                                        x-description="Heroicon name: outline/cog"
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
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
    
            <div class="flex flex-1 flex-col lg:pl-64">
                <div
                    class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none"
                >
                    <button
                        type="button"
                        class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden"
                        x-on:click="open = true"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <svg
                            class="h-6 w-6"
                            x-description="Heroicon name: outline/bars-3-center-left"
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
                                        class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50"
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
                                            class="ml-3 hidden text-sm font-medium text-gray-700 lg:block"
                                            ><span class="sr-only"
                                                >Open user menu for </span
                                            >{{ $user->name }}</span
                                        >
                                        <svg
                                            class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block"
                                            x-description="Heroicon name: mini/chevron-down"
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
    
                                <div
                                    x-cloak
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    x-ref="menu-items"
                                    x-description="Dropdown menu, show/hide based on menu state."
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
                                        x-bind:class="{ 'bg-gray-100': activeIndex === 2 }"
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