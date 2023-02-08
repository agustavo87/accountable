<x-layouts.with-nav class="h-full">
    <div class="py-10">
        @if ($title ?? null)
            <header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1
                        class="text-3xl font-bold leading-tight tracking-tight text-gray-900"
                    >
                        {{ $title ?? 'Dashboard' }}
                    </h1>
                </div>
            </header>
        @endif
        <main>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                <div class="px-4 py-8 sm:px-0">
                    <div  class="h-96">
                        {{ $slot }}
                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
</x-layouts.with-nav >
