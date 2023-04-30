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
                                <x-icons.x-mark class="h-6 w-6 text-white" />
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
                            <x-side-bar.button href="{{ route('settings') }}" class="text-sm">
                                <x-icons.cog-outline class="mr-4 h-6 w-6 text-turquoise" />
                                Settings
                            </x-side-bar.button>
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
                        <x-side-bar.button href="{{ route('settings') }}" class="text-sm">
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
                        <x-icons.bars-3 class="h-6 w-6" />
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
                            <livewire:user.dropdown :user="$user" />
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>    
</x-layouts.master>