<div
    x-data="menu({ open: false })"
    x-on:keydown.escape.stop="open = false; focusButton()"
    x-on:click.away="onClickAway($event)"
    class="relative ml-3"
>
    <div>
        <button
            type="button"
            class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="" />
        </button>
    </div>

    {{-- Dropdown menu, show/hide based on menu state. --}}
    <div
        x-cloak 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
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
            href="#"
            class="block px-4 py-2 text-sm text-gray-700"
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
            href="{{ route('user.logout')}}"
            class="block px-4 py-2 text-sm text-gray-700"
            x-bind:class="{ 'bg-gray-100': activeIndex === 1 }"
            role="menuitem"
            tabindex="-1"
            id="user-menu-item-1"
            x-on:mouseenter="activeIndex = 1"
            x-on:mouseleave="activeIndex = -1"
            x-on:click="open = false; focusButton()"
            >Sign out</a
        >
    </div>
</div>