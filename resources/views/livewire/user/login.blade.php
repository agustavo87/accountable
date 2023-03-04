<div class="flex min-h-full flex-col justify-center py-10 sm:mt-8 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:max-w-md sm:mx-auto sm:w-full">
        <x-logo-vertical class="text-deep h-40 w-auto" text-color=" text-deep" slogan-color="text-deep-light"/>
        <h2
            class="mt-6 text-center text-lg font-bold tracking-tight text-gray-600"
        >
            Sign in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <!-- space -->
            <a
                href="{{ route('user.register') }}"
                class="font-medium text-deep-light hover:text-turquoise"
                >sign up!</a
            >
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-sm sm:px-10">
            <form  wire:submit.prevent="submit" class="space-y-6">
                <x-form.input 
                    type="email"
                    wire:model.defer="email"
                    label="Email address" 
                    name="email"
                    id="email"
                    required=""
                    autocomplete="email"
                />

                <x-form.input 
                    type="password"
                    wire:model.defer="password"
                    label="Password" 
                    name="password"
                    id="password"
                    required=""
                    autocomplete="current-password"
                />

                <x-form.checkbox 
                    wire:model.defer="remember"
                    id="remember-me"
                    name="remember-me"
                />

                <div>
                    <x-form.primary-button type="submit" class="w-full">
                        Login
                    </x-form.primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
