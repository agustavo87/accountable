<main class="flex-1 pb-8">

    <x-dashboard.page-header :user="$user" />

    <div class="mt-8">

        <livewire:dashboard.overview />

        <div class="mx-auto mt-8 max-w-6xl px-4 text-lg font-medium leading-6 text-gray-900 sm:px-6 lg:px-8">
            <h2 class="ml-2 text-gray-600">Recent activity</h2>
        </div>
        
        <livewire:dashboard.recent-activity />

    </div>
</main>

