@props(['user'])
<div class="border-t border-gray-200 pt-4 pb-3">
    <div class="flex items-center px-4">
        <div class="h-8 w-8 bg-gray-50 border-4 border-gray-50 text-gray-300 inline-block overflow-hidden rounded-full ">
            <x-icons.user-solid class="h-6 w-6" />
        </div>
        <div class="ml-3">
            <div class="text-base font-medium text-gray-800" >
                {{ $user->name }}
            </div>
            <div class="text-sm font-medium text-gray-500">
                {{ $user->email }}
            </div>
        </div>

    </div>
    <div class="mt-3 space-y-1">
        <a
            href="{{ route('user.logout')}}"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
            >Sign out</a
        >
    </div>
</div>