<x-layouts.master class="h-full">
    <div {{ $attributes->merge(['class' => 'min-h-full']) }}>

        <x-layouts.top-nav-bar />

        {{ $slot }}


    </div>
</x-layouts.master>
