<main class="flex-1 pb-8">

    <x-dashboard.page-header :user="$user" />

    <div class="mt-8">

        <livewire:dashboard.overview />

        <h2 class="mx-auto mt-8 max-w-6xl px-4 text-lg font-medium leading-6 text-gray-900 sm:px-6 lg:px-8">
            Recent activity
        </h2>
        
        <livewire:dashboard.recent-activity />

    </div>
</main>

