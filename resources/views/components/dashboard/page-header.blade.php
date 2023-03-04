<div class="bg-white shadow">
    <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
        <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
            <div class="min-w-0 flex-1">
                <!-- Profile -->
                <div class="flex items-center">
                    <img
                        class="hidden h-16 w-16 rounded-full sm:block"
                        src="{{ $user->gravatar }}"
                        alt="Avatar"
                    />
                    <div>
                        <div class="flex items-center">
                            <img
                                class="h-16 w-16 rounded-full sm:hidden"
                                src="{{$user->gravatar}}"
                                alt="Avatar"
                            />
                            <h1
                                class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9"
                            >
                                Hello {{ $user->name }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <a
                    href="{{route('account.create')}}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-deep focus:ring-offset-2"
                >
                    Create Account
                </a>
                <a
                    href="{{route('operation.create')}}"
                    class="inline-flex items-center rounded-md border border-transparent bg-deep-light px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-deep-dark focus:outline-none focus:ring-2 focus:ring-deep focus:ring-offset-2"
                >
                    Create Operation
                </a>
            </div>
        </div>
    </div>
</div>