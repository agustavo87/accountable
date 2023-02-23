<div class="flex min-h-full flex-col justify-center py-10 sm:mt-1 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:max-w-md sm:mx-auto sm:w-full">
        <x-logo-vertical class="text-cyan-600 h-40 w-auto" text-color="text-gray-700"/>
        <h2
            class="mt-6 text-center text-lg font-bold tracking-tight text-gray-500"
        >
            Create an account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <!-- space -->
            <a
                href="{{ route('user.login') }}"
                class="font-medium text-cyan-600 hover:text-cyan-500"
                >sign in!</a
            >
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form  wire:submit.prevent="submit" class="space-y-6">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Name</label
                    >
                    <div class="mt-1">
                        <input
                            wire:model.defer="user.name" 
                            id="name"
                            name="name"
                            type="name"
                            autocomplete="name"
                            required=""
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
                        />
                    </div>
                </div>
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                        >Email address</label
                    >
                    <div class="mt-1">
                        <input
                            wire:model.defer="user.email" 
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required=""
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
                        />
                    </div>
                </div>

                <div>
                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700"
                        >Password</label
                    >
                    <div class="mt-1">
                        <input
                            wire:model.defer="password" 
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required=""
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-cyan-500 sm:text-sm"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="flex w-full justify-center rounded-md border border-transparent bg-cyan-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
                    >
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
