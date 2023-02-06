@props(['user'])
<div class="border-t border-gray-200 pt-4 pb-3">
    <div class="flex items-center px-4">
        <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="" />
        </div>
        <div class="ml-3">
            <div class="text-base font-medium text-gray-800" >
                {{ $user->name }}
            </div>
            <div class="text-sm font-medium text-gray-500">
                {{ $user->email }}
            </div>
        </div>

        {{-- <x-mobile-notifications-button /> --}}

    </div>
    <div class="mt-3 space-y-1">
        <a
            href="#"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
            >Your Profile</a
        >

        <a
            href="{{ route('user.logout')}}"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
            >Sign out</a
        >
    </div>
</div>