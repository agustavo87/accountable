<div class="flex min-h-full flex-col justify-center py-10 sm:mt-1 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:max-w-md sm:mx-auto sm:w-full">
        <x-logo-vertical class="text-deep h-40 w-auto" text-color="text-deep" slogan-color="text-deep-light"/>
        <h2
            class="mt-6 text-center text-lg font-bold tracking-tight text-gray-600"
        >
            Create an account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-700">
            Or
            <!-- space -->
            <a
                href="{{ route('user.login') }}"
                class="font-medium text-deep-light hover:text-turquoise"
                >sign in!</a
            >
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form  wire:submit.prevent="submit" class="space-y-6">
                <x-form.input id="name">
                    <x-slot:label>Name</x-slot>
                    <x-slot:input
                        autocomplete="name"
                        required=""
                        wire:model.defer="user.name"
                    ></x-slot>
                </x-form.input>
                <x-form.input id="email">
                    <x-slot:label>Email address</x-slot>
                    <x-slot:input
                        type="email"
                        autocomplete="email"
                        required=""
                        wire:model.defer="user.email"
                    ></x-slot>
                </x-form.input>
                <x-form.input id="password">
                    <x-slot:label>Password</x-slot>
                    <x-slot:input
                        type="password"
                        autocomplete="password"
                        required=""
                        wire:model.defer="password"
                    ></x-slot>
                </x-form.input>

                <div>
                    <x-form.primary-button type="submit" class="w-full">
                        Register
                    </x-form.primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
