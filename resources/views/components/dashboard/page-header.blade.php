<div class="bg-white shadow">
    <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
        <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
            <div class="min-w-0 flex-1">
                <!-- Profile -->
                <div class="flex items-center">
                    <img
                        class="hidden h-16 w-16 rounded-full sm:block border-4 border-gray-300"
                        src="{{ $user->gravatar }}"
                        alt="Avatar"
                    />
                    <div>
                        <div class="flex items-center">
                            <img
                                class="h-16 w-16 rounded-full sm:hidden border-4 border-gray-30"
                                src="{{$user->gravatar}}"
                                alt="Avatar"
                            />
                            <div class="ml-5 flex flex-col">
                                <h1
                                    class="text-2xl font-bold leading-none text-deep-light sm:truncate"
                                >
                                    Hello {{ $user->name }}
                                </h1>
                                <h4 class="text-xs text-gray-500 font-semibold tracking-wide mt-1">{{ now()->toFormattedDayDateString() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex gap-2 md:mt-0 md:ml-4">
                <x-tertiary-button href="{{route('account.create')}}" class="bg-white">
                    Create Account
                </x-tertiary-button>
                <x-primary-button href="{{route('operation.create')}}">
                    Create Operation
                </x-primary-button>
            </div>
        </div>
    </div>
</div>