<div class="bg-gray-100">
    <div class="mx-auto max-w-6xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Create Operation
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Create an operation with one or more account movements.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form 
                    x-data="{dirty:@entangle('dirty').defer}"
                    x-on:input="dirty = true"
                    wire:submit.prevent="submit"
                >
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="bg-white flex flex-col gap-3 px-4 py-5 sm:p-6">

                            <div class="grid grid-cols-6 gap-6">
                                <x-form.input 
                                    class="col-span-6 sm:col-span-3"
                                    id='name'
                                >
                                    <x-slot:label>
                                        Name
                                    </x-slot>
                                    <x-slot:input 
                                        wire:model.defer="operation.name" 
                                        autocomplete="off"
                                        placeholder="Buy x units of y..."
                                    >
                                    </x-slot>
                                </x-form.input> 

                                <x-form.complex-select 
                                    wire:model.defer="category"
                                    class="col-span-6 sm:col-span-3"
                                    id="category"
                                >
                                    <x-slot:label>
                                        Category
                                    </x-slot>
                                    <x-slot:options
                                        autocomplete="category"
                                    >
                                        <option selected hidden>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" class="text-deep-dark">{{$category->name}}</option>
                                        @endforeach
                                    </x-slot>
                                    <div class="flex justify-end">
                                        <x-error class="flex-1" for="category" />
                                        <button
                                            type="button"
                                            x-on:click="$dispatch('create-category')"
                                            class="link text-xs font-medium mt-1 mr-1 self-end ">
                                            Create new
                                        </button>
                                    </div>
                                </x-form.complex-select>
                            </div>

                            <x-form.text-area 
                                id="notes"
                                rows="3"
                                wire:model.defer="operation.notes"
                                placeholder="Operation details..."
                                rows="3"
                            >
                                <x-slot:label>Notes</x-slot>
                                <x-slot:hint>Notes about the operation.</x-slot>
                            </x-form.text-area>

                        </div>
                        <div class="bg-gray-100 py-6">
                            <h4 class="font-semibold mb-2 ml-5 text-base text-gray-600">
                                Transactions
                            </h4>
                            <div x-data="{movements:@entangle("movements")}"></div>
                            <div class="mx-auto max-w-7xl sm:px-5">
                                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                                    <ul role="list" class="divide-y divide-gray-200">
                                        @foreach ($movements as $key => $_movement)
                                            <li class="parent-show transition-colors duration-150" wire:key="{{$key}}">
                                                <div class="block hover:bg-gray-50">
                                                    <div class="px-4 py-4 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <p class="truncate text-sm font-medium text-gray-600">
                                                                {{$_movement['account']['name']}}</p>
                                                            <div class="ml-2 flex flex-shrink-0">
                                                                <p 
                                                                    x-data="Money"
                                                                    data-amount="{{$_movement['decimal_amount']}}"
                                                                    data-currency-code="{{$_movement['account']['currency']['code']}}"
                                                                    data-scale="{{$_movement['account']['currency']['scale']}}"
                                                                    data-locale="{{$locale['js']}}"
                                                                    x-text="formated"
                                                                    class="font-medium opacity-80"
                                                                    x-bind:class="{{$_movement['type']}} ? 'text-green-800' : 'text-red-800'"
                                                                ></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 sm:flex sm:justify-between">
                                                            <div class="sm:flex">
                                                                <p class="flex items-center text-sm text-gray-500">
                                                                    @if(strlen($_movement['note']))
                                                                        <x-icons.right-arrow class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                                                                        {{ $_movement['note'] }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="md:hidden-child transition-opacity duration-100 mt-2 flex items-center justify-end gap-4 text-sm text-gray-500 sm:mt-0">
                                                                <button wire:click="remove({{$key}})" type="button" class="hover:text-red-500 text-gray-400 transition-colors">
                                                                    <x-icons.trash class="h-6 w-6 flex-shrink-0" />
                                                                </button>
                                                                <button wire:click="edit({{ $key }})" type="button" class="hover:text-blue-500 text-gray-400 transition-colors">
                                                                    <x-icons.edit class="h-6 w-6 flex-shrink-0" style="margin-top: 1.5px" />
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div wire:keydown.enter.prevent="commitMovement" class="block bg-gray-50" >

                                        <div class="px-4 py-4 sm:px-6">
        
                                            <div class="grid grid-cols-6 gap-6">
                                                <x-form.complex-select 
                                                    wire:model="movement.account_id"
                                                    id="category" 
                                                    class="col-span-6 sm:col-span-3 "
                                                >
                                                    <x-slot:label>
                                                        Account
                                                    </x-slot>
                                                    <x-slot:options
                                                        class="bg-white focus:bg-white"
                                                        autocomplete="category"
                                                    >
                                                        <option selected hidden>Select an account</option>
                                                        @foreach ($accounts as $account)
                                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </x-slot>
                                                    <div class="flex justify-end">
                                                        <x-error class="flex-1" for="movement.account_id" />
                                                        <a  
                                                            href="{{ route('account.create') }}"
                                                            class="link mt-1 mr-1 self-end text-xs font-medium"
                                                        >
                                                            Create
                                                        </a>
                                                    </div>
                                                </x-form.complex-select>
        
                                                <x-form.money-input 
                                                    wire:parameters="currencyParameters"
                                                    class=" col-span-6 sm:col-span-3"
                                                    listen="money-input-updated"
                                                >
                                                    <x-slot:label>Amount</x-slot>
                                                    <x-slot:amount
                                                        id="amount" 
                                                        wire:model="amount"
                                                    ></x-slot>
                                                    <x-slot:errors>
                                                        <x-error for="amount" />
                                                    </x-slot>
                                                </x-form.money-input>
        
                                                <x-form.input id="notes" class="col-span-6">
                                                    <x-slot:label>Notes</x-slot>
                                                    <x-slot:input
                                                        class="bg-white focus:bg-white"
                                                        wire:model.defer="movement.note"
                                                        autocomplete="off"
                                                    >
                                                    </x-slot>
                                                </x-form.input>
        
                                                <div class="col-span-6 sm:col-span-3">
                                                    <fieldset>
                                                        <div class="flex justify-around m-2">
                                                            <div class="flex items-center">
                                                                <input id="debit"
                                                                    wire:model="movement.type"
                                                                    name="type"
                                                                    type="radio"
                                                                    value="0"
                                                                    class="h-4 w-4 border-gray-300 text-deep-light focus:ring-deep">
                                                                <label for="debit"
                                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                                    Debit</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input id="credit"
                                                                    wire:model="movement.type"
                                                                    name="type"
                                                                    type="radio"
                                                                    value="1"
                                                                    class="h-4 w-4 border-gray-300 text-deep-light focus:ring-deep">
                                                                <label for="credit"
                                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                                    Credit</label>
                                                            </div>
                                                            
                                                        </div>
                                                    </fieldset>
                                                    <x-error for="movement.type" />
                                                </div>
        
                                                <div class="col-span-6 flex items-center justify-end sm:col-span-3">
                                                    <x-tertiary-button wire:click="commitMovement" type="button" class="px-3" >
                                                        Add transaction
                                                    </x-tertiary-button>
                                                </div>
                                            </div>
                                        </div>
                                        <x-error for="movements" class="px-6 py-5" non-specific />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <x-primary-button type="submit">
                                Create Operation
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
@pushOnce('modals')
    <livewire:category.create />
@endPushOnce
