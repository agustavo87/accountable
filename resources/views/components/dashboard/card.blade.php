<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-lg bg-white shadow mb-5'])}}>
    <div class="p-5">
        <div class="flex items-center">
            <div class="flex-shrink-0">

                {{ $icon }}

            </div>
            <div class="ml-5 w-0 flex-1">

                {{ $slot }}

            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-5 py-3">
        <div class="text-sm">

            {{ $foot }}

        </div>
    </div>
</div>
