
<x-layouts.master class="h-full bg-gray-100" >

    <div class="h-[640px] overflow-y-auto bg-gray-100">
        <!--
        This example requires updating your template:
      
        ```
        <html class="h-full bg-gray-100">
        <body class="h-full">
        ```
        -->
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
                            <img
                                class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=cyan&amp;shade=300"
                                alt="Easywire logo"
                            />
                        </div>
                        <nav
                            class="mt-5 h-full flex-shrink-0 divide-y divide-cyan-800 overflow-y-auto"
                            aria-label="Sidebar"
                        >
                            <div class="space-y-1 px-2">
                                <a
                                    href="#"
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
                                    Home
                                </a>
    
                                <a
                                    href="#"
                                    class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                        x-description="Heroicon name: outline/clock"
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
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    History
                                </a>
    
                                <a
                                    href="#"
                                    class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                        x-description="Heroicon name: outline/scale"
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
                                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"
                                        ></path>
                                    </svg>
                                    Balances
                                </a>
    
                                <a
                                    href="#"
                                    class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                        x-description="Heroicon name: outline/credit-card"
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
                                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"
                                        ></path>
                                    </svg>
                                    Cards
                                </a>
    
                                <a
                                    href="#"
                                    class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                        x-description="Heroicon name: outline/user-group"
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
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                        ></path>
                                    </svg>
                                    Recipients
                                </a>
    
                                <a
                                    href="#"
                                    class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                        x-description="Heroicon name: outline/document-chart-bar"
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
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                        ></path>
                                    </svg>
                                    Reports
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
    
                                    <a
                                        href="#"
                                        class="group flex items-center rounded-md px-2 py-2 text-base font-medium text-cyan-100 hover:bg-cyan-600 hover:text-white"
                                    >
                                        <svg
                                            class="mr-4 h-6 w-6 text-cyan-200"
                                            x-description="Heroicon name: outline/question-mark-circle"
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
                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                                            ></path>
                                        </svg>
                                        Help
                                    </a>
    
                                    <a
                                        href="#"
                                        class="group flex items-center rounded-md px-2 py-2 text-base font-medium text-cyan-100 hover:bg-cyan-600 hover:text-white"
                                    >
                                        <svg
                                            class="mr-4 h-6 w-6 text-cyan-200"
                                            x-description="Heroicon name: outline/shield-check"
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
                                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                            ></path>
                                        </svg>
                                        Privacy
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
                        <img
                            class="h-8 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=cyan&amp;shade=300"
                            alt="Easywire logo"
                        />
                    </div>
                    <nav
                        class="mt-5 flex flex-1 flex-col divide-y divide-cyan-800 overflow-y-auto"
                        aria-label="Sidebar"
                    >
                        <div class="space-y-1 px-2">
                            <a
                                href="#"
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
                                Home
                            </a>
    
                            <a
                                href="#"
                                class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                            >
                                <svg
                                    class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                    x-description="Heroicon name: outline/clock"
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
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                History
                            </a>
    
                            <a
                                href="#"
                                class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                            >
                                <svg
                                    class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                    x-description="Heroicon name: outline/scale"
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
                                        d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"
                                    ></path>
                                </svg>
                                Balances
                            </a>
    
                            <a
                                href="#"
                                class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                            >
                                <svg
                                    class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                    x-description="Heroicon name: outline/credit-card"
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
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"
                                    ></path>
                                </svg>
                                Cards
                            </a>
    
                            <a
                                href="#"
                                class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                            >
                                <svg
                                    class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                    x-description="Heroicon name: outline/user-group"
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
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                    ></path>
                                </svg>
                                Recipients
                            </a>
    
                            <a
                                href="#"
                                class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                x-state-description='undefined: "bg-cyan-800 text-white", undefined: "text-cyan-100 hover:text-white hover:bg-cyan-600"'
                            >
                                <svg
                                    class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                    x-description="Heroicon name: outline/document-chart-bar"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                    ></path>
                                </svg>
                                Reports
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
    
                                <a
                                    href="#"
                                    class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-cyan-100 hover:bg-cyan-600 hover:text-white"
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 text-cyan-200"
                                        x-description="Heroicon name: outline/question-mark-circle"
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
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                                        ></path>
                                    </svg>
                                    Help
                                </a>
    
                                <a
                                    href="#"
                                    class="group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6 text-cyan-100 hover:bg-cyan-600 hover:text-white"
                                >
                                    <svg
                                        class="mr-4 h-6 w-6 text-cyan-200"
                                        x-description="Heroicon name: outline/shield-check"
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
                                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                        ></path>
                                    </svg>
                                    Privacy
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
                        <div class="flex flex-1">
                            <form
                                class="flex w-full md:ml-0"
                                action="#"
                                method="GET"
                            >
                                <label for="search-field" class="sr-only"
                                    >Search</label
                                >
                                <div
                                    class="relative w-full text-gray-400 focus-within:text-gray-600"
                                >
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            x-description="Heroicon name: mini/magnifying-glass"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                    <input
                                        id="search-field"
                                        name="search-field"
                                        class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                                        placeholder="Search transactions"
                                        type="search"
                                    />
                                </div>
                            </form>
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            <button
                                type="button"
                                class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
                            >
                                <span class="sr-only">View notifications</span>
                                <svg
                                    class="h-6 w-6"
                                    x-description="Heroicon name: outline/bell"
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
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                                    ></path>
                                </svg>
                            </button>
    
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
                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                            alt=""
                                        />
                                        <span
                                            class="ml-3 hidden text-sm font-medium text-gray-700 lg:block"
                                            ><span class="sr-only"
                                                >Open user menu for </span
                                            >Emilia Birch</span
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
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700"
                                        x-state:on="Active"
                                        x-state:off="Not Active"
                                        x-bind:class="{ 'bg-gray-100': activeIndex === 0 }"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="user-menu-item-0"
                                        x-on:mouseenter="activeIndex = 0"
                                        x-on:mouseleave="activeIndex = -1"
                                        x-on:click="open = false; focusButton()"
                                        >Your Profile</a
                                    >
                                    <a
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700"
                                        x-bind:class="{ 'bg-gray-100': activeIndex === 1 }"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="user-menu-item-1"
                                        x-on:mouseenter="activeIndex = 1"
                                        x-on:mouseleave="activeIndex = -1"
                                        x-on:click="open = false; focusButton()"
                                        >Settings</a
                                    >
                                    <a
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700"
                                        x-bind:class="{ 'bg-gray-100': activeIndex === 2 }"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="user-menu-item-2"
                                        x-on:mouseenter="activeIndex = 2"
                                        x-on:mouseleave="activeIndex = -1"
                                        x-on:click="open = false; focusButton()"
                                        >Logout</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <main class="flex-1 pb-8">
                    <!-- Page header -->
                    <div class="bg-white shadow">
                        <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
                            <div
                                class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
                            >
                                <div class="min-w-0 flex-1">
                                    <!-- Profile -->
                                    <div class="flex items-center">
                                        <img
                                            class="hidden h-16 w-16 rounded-full sm:block"
                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2.6&amp;w=256&amp;h=256&amp;q=80"
                                            alt=""
                                        />
                                        <div>
                                            <div class="flex items-center">
                                                <img
                                                    class="h-16 w-16 rounded-full sm:hidden"
                                                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2.6&amp;w=256&amp;h=256&amp;q=80"
                                                    alt=""
                                                />
                                                <h1
                                                    class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9"
                                                >
                                                    Good morning, Emilia Birch
                                                </h1>
                                            </div>
                                            <dl
                                                class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap"
                                            >
                                                <dt class="sr-only">Company</dt>
                                                <dd
                                                    class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6"
                                                >
                                                    <svg
                                                        class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                        x-description="Heroicon name: mini/building-office"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M4 16.5v-13h-.25a.75.75 0 010-1.5h12.5a.75.75 0 010 1.5H16v13h.25a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75v-2.5a.75.75 0 00-.75-.75h-2.5a.75.75 0 00-.75.75v2.5a.75.75 0 01-.75.75h-3.5a.75.75 0 010-1.5H4zm3-11a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM7.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM11 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm.5 3.5a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1z"
                                                            clip-rule="evenodd"
                                                        ></path>
                                                    </svg>
                                                    Duke street studio
                                                </dd>
                                                <dt class="sr-only">
                                                    Account status
                                                </dt>
                                                <dd
                                                    class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0"
                                                >
                                                    <svg
                                                        class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                                        x-description="Heroicon name: mini/check-circle"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                            clip-rule="evenodd"
                                                        ></path>
                                                    </svg>
                                                    Verified account
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
                                    >
                                        Add money
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
                                    >
                                        Send money
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-8">
                        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                            <h2 class="text-lg font-medium leading-6 text-gray-900">
                                Overview
                            </h2>
                            <div
                                class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3"
                            >
                                <!-- Card -->
    
                                <div
                                    class="overflow-hidden rounded-lg bg-white shadow"
                                >
                                    <div class="p-5">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg
                                                    class="h-6 w-6 text-gray-400"
                                                    x-description="Heroicon name: outline/scale"
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
                                                        d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt
                                                        class="truncate text-sm font-medium text-gray-500"
                                                    >
                                                        Account balance
                                                    </dt>
                                                    <dd>
                                                        <div
                                                            class="text-lg font-medium text-gray-900"
                                                        >
                                                            $30,659.45
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-5 py-3">
                                        <div class="text-sm">
                                            <a
                                                href="#"
                                                class="font-medium text-cyan-700 hover:text-cyan-900"
                                                >View all</a
                                            >
                                        </div>
                                    </div>
                                </div>
    
                                <div
                                    class="overflow-hidden rounded-lg bg-white shadow"
                                >
                                    <div class="p-5">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg
                                                    class="h-6 w-6 text-gray-400"
                                                    x-description="Heroicon name: outline/arrow-path"
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
                                                        d="M4.5 12c0-1.232.046-2.453.138-3.662a4.006 4.006 0 013.7-3.7 48.678 48.678 0 017.324 0 4.006 4.006 0 013.7 3.7c.017.22.032.441.046.662M4.5 12l-3-3m3 3l3-3m12 3c0 1.232-.046 2.453-.138 3.662a4.006 4.006 0 01-3.7 3.7 48.657 48.657 0 01-7.324 0 4.006 4.006 0 01-3.7-3.7c-.017-.22-.032-.441-.046-.662M19.5 12l-3 3m3-3l3 3"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt
                                                        class="truncate text-sm font-medium text-gray-500"
                                                    >
                                                        Pending
                                                    </dt>
                                                    <dd>
                                                        <div
                                                            class="text-lg font-medium text-gray-900"
                                                        >
                                                            -$19,500.00
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-5 py-3">
                                        <div class="text-sm">
                                            <a
                                                href="#"
                                                class="font-medium text-cyan-700 hover:text-cyan-900"
                                                >View all</a
                                            >
                                        </div>
                                    </div>
                                </div>
    
                                <div
                                    class="overflow-hidden rounded-lg bg-white shadow"
                                >
                                    <div class="p-5">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg
                                                    class="h-6 w-6 text-gray-400"
                                                    x-description="Heroicon name: outline/check-circle"
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
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt
                                                        class="truncate text-sm font-medium text-gray-500"
                                                    >
                                                        Processed (last 30 days)
                                                    </dt>
                                                    <dd>
                                                        <div
                                                            class="text-lg font-medium text-gray-900"
                                                        >
                                                            $20,000
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-5 py-3">
                                        <div class="text-sm">
                                            <a
                                                href="#"
                                                class="font-medium text-cyan-700 hover:text-cyan-900"
                                                >View all</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <h2
                            class="mx-auto mt-8 max-w-6xl px-4 text-lg font-medium leading-6 text-gray-900 sm:px-6 lg:px-8"
                        >
                            Recent activity
                        </h2>
    
                        <!-- Activity list (smallest breakpoint only) -->
                        <div class="shadow sm:hidden">
                            <ul
                                role="list"
                                class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden"
                            >
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Molly
                                                        Sanders</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-07-11"
                                                        >July 11, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Doug Mann</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-07-05"
                                                        >July 5, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Erica
                                                        Frost</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-07-04"
                                                        >July 4, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Miley
                                                        Davis</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-07-01"
                                                        >July 1, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Molly
                                                        Sanders</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-06-17"
                                                        >June 17, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Doug Mann</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-06-14"
                                                        >June 14, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Erica
                                                        Frost</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-06-03"
                                                        >June 3, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Miley
                                                        Davis</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-05-08"
                                                        >May 8, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Molly
                                                        Sanders</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-05-05"
                                                        >May 5, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Doug Mann</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-05-01"
                                                        >May 1, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Erica
                                                        Frost</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-04-14"
                                                        >April 14, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Miley
                                                        Davis</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-04-11"
                                                        >April 11, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Molly
                                                        Sanders</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-04-03"
                                                        >April 3, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Doug Mann</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-04-02"
                                                        >April 2, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Erica
                                                        Frost</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-03-29"
                                                        >March 29, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
    
                                <li>
                                    <a
                                        href="#"
                                        class="block bg-white px-4 py-4 hover:bg-gray-50"
                                    >
                                        <span class="flex items-center space-x-4">
                                            <span
                                                class="flex flex-1 space-x-2 truncate"
                                            >
                                                <svg
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    x-description="Heroicon name: mini/banknotes"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="flex flex-col truncate text-sm text-gray-500"
                                                >
                                                    <span class="truncate"
                                                        >Payment to Miley
                                                        Davis</span
                                                    >
                                                    <span
                                                        ><span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD</span
                                                    >
                                                    <time datetime="2020-03-15"
                                                        >March 15, 2020</time
                                                    >
                                                </span>
                                            </span>
                                            <svg
                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                x-description="Heroicon name: mini/chevron-right"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            </ul>
    
                            <nav
                                class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3"
                                aria-label="Pagination"
                            >
                                <div class="flex flex-1 justify-between">
                                    <a
                                        href="#"
                                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500"
                                        >Previous</a
                                    >
                                    <a
                                        href="#"
                                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500"
                                        >Next</a
                                    >
                                </div>
                            </nav>
                        </div>
    
                        <!-- Activity table (small breakpoint and up) -->
                        <div class="hidden sm:block">
                            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                                <div class="mt-2 flex flex-col">
                                    <div
                                        class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg"
                                    >
                                        <table
                                            class="min-w-full divide-y divide-gray-200"
                                        >
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="bg-gray-50 px-6 py-3 text-left text-sm font-semibold text-gray-900 border-0"
                                                        scope="col"
                                                    >
                                                        Transaction
                                                    </th>
                                                    <th
                                                        class="bg-gray-50 px-6 py-3 text-right text-sm font-semibold text-gray-900 border-0"
                                                        scope="col"
                                                    >
                                                        Amount
                                                    </th>
                                                    <th
                                                        class="hidden bg-gray-50 px-6 py-3 text-left text-sm font-semibold text-gray-900 md:block border-0"
                                                        scope="col"
                                                    >
                                                        Status
                                                    </th>
                                                    <th
                                                        class="bg-gray-50 px-6 py-3 text-right text-sm font-semibold text-gray-900 border-0"
                                                        scope="col"
                                                    >
                                                        Date
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200 bg-white"
                                            >
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Molly
                                                                    Sanders
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-07-11"
                                                            >July 11, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Doug
                                                                    Mann
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 capitalize"
                                                            >processing</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-07-05"
                                                            >July 5, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Erica
                                                                    Frost
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-07-04"
                                                            >July 4, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Miley
                                                                    Davis
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-07-01"
                                                            >July 1, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Molly
                                                                    Sanders
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize"
                                                            >failed</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-06-17"
                                                            >June 17, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Doug
                                                                    Mann
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 capitalize"
                                                            >processing</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-06-14"
                                                            >June 14, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Erica
                                                                    Frost
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-06-03"
                                                            >June 3, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Miley
                                                                    Davis
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-05-08"
                                                            >May 8, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Molly
                                                                    Sanders
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-05-05"
                                                            >May 5, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Doug
                                                                    Mann
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 capitalize"
                                                            >processing</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-05-01"
                                                            >May 1, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Erica
                                                                    Frost
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize"
                                                            >failed</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-04-14"
                                                            >April 14, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Miley
                                                                    Davis
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-04-11"
                                                            >April 11, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Molly
                                                                    Sanders
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$20,000</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-04-03"
                                                            >April 3, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Doug
                                                                    Mann
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$19,500</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 capitalize"
                                                            >processing</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-04-02"
                                                            >April 2, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Erica
                                                                    Frost
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$8,750</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-03-29"
                                                            >March 29, 2020</time
                                                        >
                                                    </td>
                                                </tr>
    
                                                <tr class="bg-white">
                                                    <td
                                                        class="w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                                    >
                                                        <div class="flex">
                                                            <a
                                                                href="#"
                                                                class="group inline-flex space-x-2 truncate text-sm"
                                                            >
                                                                <svg
                                                                    class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                                    x-description="Heroicon name: mini/banknotes"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                                <p
                                                                    class="truncate text-gray-500 group-hover:text-gray-900"
                                                                >
                                                                    Payment to Miley
                                                                    Davis
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >$300</span
                                                        >
                                                        USD
                                                    </td>
                                                    <td
                                                        class="hidden whitespace-nowrap px-6 py-4 text-sm text-gray-500 md:block"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize"
                                                            >success</span
                                                        >
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                                    >
                                                        <time datetime="2020-03-15"
                                                            >March 15, 2020</time
                                                        >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Pagination -->
                                        <nav
                                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                                            aria-label="Pagination"
                                        >
                                            <div class="hidden sm:block">
                                                <p class="text-sm text-gray-700">
                                                    Showing
                                                    <!-- space -->
                                                    <span class="font-medium"
                                                        >1</span
                                                    >
                                                    <!-- space -->
                                                    to
                                                    <!-- space -->
                                                    <span class="font-medium"
                                                        >10</span
                                                    >
                                                    <!-- space -->
                                                    of
                                                    <!-- space -->
                                                    <span class="font-medium"
                                                        >20</span
                                                    >
                                                    <!-- space -->
                                                    results
                                                </p>
                                            </div>
                                            <div
                                                class="flex flex-1 justify-between sm:justify-end"
                                            >
                                                <a
                                                    href="#"
                                                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                                    >Previous</a
                                                >
                                                <a
                                                    href="#"
                                                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                                    >Next</a
                                                >
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-layouts.master>
