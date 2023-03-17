<div
    x-data="Components.menu({ open: false})"
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
            <span class="ml-3 hidden text-sm font-medium text-gray-500 lg:block">
                <span  class="sr-only" >
                    Open user menu for 
                </span>
                <span>
                    {{ $user->name }}
                </span>
            </span>
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
        >
            Logout
        </a>
    </div>
</div>