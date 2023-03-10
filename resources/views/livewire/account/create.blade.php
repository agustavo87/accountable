<div class="bg-gray-100">
    <div class="mx-auto max-w-6xl py-6 sm:px-6 lg:px-8">
        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Account
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Specify information of the account.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form wire:submit.prevent="create">
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <x-form.complex-text-input 
                                        class="col-span-6 sm:col-span-3"
                                        id='name'
                                    >
                                        <x-slot:label>
                                            Account Name
                                        </x-slot>
                                        <x-slot:input 
                                            wire:model.debounce="account.name" 
                                            autocomplete="off"
                                            placeholder="Bank XXX CC..."
                                        >
                                        </x-slot>
                                    </x-form.complex-text-input>
                                    <x-form.money-input 
                                        class="col-span-6 sm:col-span-3"
                                        id="balance"
                                    >
                                        <x-slot:input
                                            wire:model.debounce="account.balance"
                                        ></x-slot>
                                        <x-slot:currencies>
                                            @foreach ($currencies as $currency)
                                                <option value="{{$currency}}">{{ $currency }}</option>
                                            @endforeach
                                        </x-slot>
                                    </x-form.money-input>
                                </div>

                                <x-form.text-area 
                                    id="description"
                                    rows="3"
                                    placeholder="This is account is for..."
                                >
                                    <x-slot:label>Description</x-slot>
                                    <x-slot:hint>Brief description of the account.</x-slot>
                                </x-form.text-area>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <x-primary-button type="submit">
                                    Create
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
