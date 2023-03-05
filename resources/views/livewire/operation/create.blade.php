<div class="bg-gray-100">
    <div class="mx-auto max-w-6xl py-6 sm:px-6 lg:px-8">
        <div>
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
                        wire:submit.prevent="submit">
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Name
                                        </label>
                                        <input type="text" name="name" id="name"
                                            wire:model.defer="operation.name" 
                                            autocomplete="off"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-deep focus:ring-deep sm:text-sm">
                                        <x-error for="operation.name" />
                                    </div>

                                    <div class="col-span-6 flex flex-col sm:col-span-3">
                                        <label for="category"
                                            class="block text-sm font-medium text-gray-700">Category</label>
                                        <select wire:model.defer="category" id="category" name="category" autocomplete="category"
                                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-deep focus:outline-none focus:ring-deep sm:text-sm">
                                            <option selected hidden>Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="flex justify-end">
                                            <x-error class="flex-1" for="category" />
                                            <button
                                                type="button"
                                                x-on:click="$dispatch('create-category')"
                                                class="mt-1 mr-1 self-end text-xs text-deep hover:text-cyan-400 font-medium">Create new</button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <div class="mt-1">
                                        <textarea id="notes" name="notes" rows="3"
                                            wire:model.defer="operation.notes"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-deep focus:ring-deep sm:text-sm"
                                            placeholder="Operation details..."></textarea>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Notes about the operation.
                                    </p>
                                    <x-error for="operation.notes" />
                                </div>


                            </div>
                            <div class="bg-gray-100 py-6">
                                <h4 class="font-semibold mb-2 ml-5 text-base text-gray-600">
                                    Transactions
                                </h4>
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
                                                                    <p class="font-medium opacity-80 {{ $_movement['type'] ? 'text-green-800' : 'text-red-800'}}">
                                                                        {{($_movement['type'] == 1 ? '$' : '-$'). $_movement['amount']}} 
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 sm:flex sm:justify-between">
                                                                <div class="sm:flex">
                                                                    <p class="flex items-center text-sm text-gray-500">
                                                                        @if(strlen($_movement['note']))
                                                                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                                                            </svg>
                                                                            {{ $_movement['note'] }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="md:hidden-child transition-opacity duration-100 mt-2 flex items-center justify-end gap-4 text-sm text-gray-500 sm:mt-0">
                                                                    <button wire:click="remove({{$key}})" type="button" class="hover:text-red-500 text-gray-400 transition-colors">
                                                                        <svg class="h-6 w-6 flex-shrink-0"
                                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </button>
                                                                    <button wire:click="edit({{ $key }})" type="button" class="hover:text-blue-500 text-gray-400 transition-colors">
                                                                        <svg class="h-6 w-6 flex-shrink-0" style="margin-top: 1.5px; "
                                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                            <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                                            <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                            <li>
                                                <div wire:keydown.enter.prevent="commitMovement" class="block bg-gray-50" >

                                                    <div class="px-4 py-4 sm:px-6">

                                                        <div class="grid grid-cols-6 gap-6">

                                                            <div class="col-span-6 sm:col-span-3 flex flex-col">
                                                                <label for="account"
                                                                    class="block text-sm font-medium text-gray-700">Account</label>
                                                                <select 
                                                                    wire:model.defer="movement.account_id" id="account" name="account"
                                                                    autocomplete="account"
                                                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-deep focus:outline-none focus:ring-deep sm:text-sm">
                                                                   <option selected hidden>Select an account</option>
                                                                   @foreach ($accounts as $account)
                                                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                                                   @endforeach
                                                                </select>
                                                                <div class="flex justify-end">
                                                                    <x-error class="flex-1" for="movement.account_id" />
                                                                    <a  
                                                                        href="{{ route('account.create') }}"
                                                                        class="mt-1 mr-1 self-end text-xs text-deep hover:text-cyan-400 font-medium"
                                                                        >Create</a>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-6 sm:col-span-3">
                                                                <label for="amount"
                                                                    class="block text-sm font-medium text-gray-700">
                                                                    Amount
                                                                </label>
                                                                <input type="number" name="amount"
                                                                    wire:model.defer="movement.amount"
                                                                    id="amount"
                                                                    autocomplete="off"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-deep focus:ring-deep sm:text-sm">
                                                                <x-error for="movement.amount" />
                                                            </div>

                                                            <div class="col-span-6">
                                                                <label for="notes"
                                                                    class="block text-sm font-medium text-gray-700">
                                                                    Notes
                                                                </label>
                                                                <input type="text" name="notes"
                                                                    wire:model.defer="movement.note"
                                                                    autocomplete="off"
                                                                    id="notes"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-deep focus:ring-deep sm:text-sm">
                                                                <x-error for="movement.note" />
                                                            </div>

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
                                            </li>

                                        </ul>
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
</div>
@pushOnce('modals')
    <livewire:category.create />
@endPushOnce
