<div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-2 items-center justify-between mb-7 sm:flex-row sm:mb-0 w-fulls">
        <div class="sm:ml-1.5 sm:w-auto w-full">
            <label for="account" class="sr-only">Account</label>
            <select 
                wire:model="account"
                id="account" 
                name="account" 
                class="bg-gray-50 border-gray-50 focus:border-gray-50 bg-transparent cursor-pointer focus:outline-none focus:ring-2 focus:ring-deep focus:ring-offset-2 focus:ring-offset-gray-100 font-medium hover:bg-white pl-2 pr-10 py-2 rounded-t sm:w-auto text-gray-900 text-lg w-full"
            >
              <option value="0">General</option>
              @foreach ($accounts as $account)
                <option value="{{$account->id}}">{{$account->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="flex gap-2 items-center ml-2 sm:ml-0 sm:w-auto w-full">
            <label for="account" class="text-sm text-gray-500 font-semibold ">Category</label>
            <select 
                wire:model="category"
                id="category" 
                name="category" 
                class="bg-gray-50 border-gray-50 focus:border-gray-50 bg-transparent cursor-pointer focus:outline-none focus:ring-2 focus:ring-deep focus:ring-offset-2 focus:ring-offset-gray-100 font-medium hover:bg-white mr-1.5 pl-2 pr-10 py-1.5 rounded-t sm:w-auto text-gray-900 text-sm w-full"
            >
                <option value="0">All</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div
        x-data="OperationsOverview({
            entangles: {
                kpi:@entangle('kpi')
            },
            locale: '{{$locale['js']}}'
        })"
        class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3"
    >
        <!-- Card -->

        <div 
            x-show="kpi.account.balance"
            class="overflow-hidden rounded-lg bg-white shadow"
        >
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        {{-- Heroicon name: outline/scale --}}
                        <svg
                            class="h-6 w-6 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                General balance
                            </dt>
                            <dd>
                                <div
                                    x-text="formatNumber(kpi.account.balance) + ' ' + kpi.account.currency"
                                    class="text-lg font-medium text-gray-900"
                                >
                                    $30,659.45
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a
                        href="#"
                        class="font-medium text-deep-dark hover:text-deep-dark"
                        >View all</a
                    >
                </div>
            </div>
        </div>


        <div
            class="overflow-hidden rounded-lg bg-white shadow"
            x-show='kpi.account.period_balance'
        >
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        {{-- Heroicon name: outline/check-circle --}}
                        <svg
                            class="h-6 w-6 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                Period Balance (last 30 days)
                            </dt>
                            <dd>
                                <div
                                    x-text="formatNumber(kpi.account.period_balance) + ' ' + kpi.account.currency"
                                    class="text-lg font-medium text-gray-900"
                                >
                                    $20,000
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a
                        href="#"
                        class="font-medium text-deep-dark hover:text-deep-dark"
                        >View all</a
                    >
                </div>
            </div>
        </div>

        <div
            class="overflow-hidden rounded-lg bg-white shadow"
            x-show="kpi.account.movements"
        >
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        {{-- Heroicon name: outline/arrow-path --}}
                        <svg
                            class="h-6 w-6 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12c0-1.232.046-2.453.138-3.662a4.006 4.006 0 013.7-3.7 48.678 48.678 0 017.324 0 4.006 4.006 0 013.7 3.7c.017.22.032.441.046.662M4.5 12l-3-3m3 3l3-3m12 3c0 1.232-.046 2.453-.138 3.662a4.006 4.006 0 01-3.7 3.7 48.657 48.657 0 01-7.324 0 4.006 4.006 0 01-3.7-3.7c-.017-.22-.032-.441-.046-.662M19.5 12l-3 3m3-3l3 3"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                Transactions
                            </dt>
                            <dd>
                                <div
                                    x-text="kpi.account.movements"
                                    class="text-lg font-medium text-gray-900"
                                >
                                    -$19,500.00
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a
                        href="#"
                        class="font-medium text-deep-dark hover:text-deep-dark"
                        >View all</a
                    >
                </div>
            </div>
        </div>
    </div>
</div>