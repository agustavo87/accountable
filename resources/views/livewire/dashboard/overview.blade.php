<div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-2 items-end justify-between mb-7 sm:flex-row sm:mb-0 w-fulls">
        <div class="sm:w-auto w-full">
            <label for="account" class="sr-only">Account</label>
            <x-form.white-select 
                wire:model="account"
                class="text-lg"
                id="account" 
                class="pl-2 pr-10 py-1.5 text-sm"
                name="account"
            >
                <option class="text-base" value="0">General</option>
                @foreach ($accounts as $account)
                    <option class="text-base" value="{{$account->id}}">{{$account->name}}</option>
                @endforeach
            </x-form.white-select>
        </div>
        <div class="flex gap-2 items-center ml-2 sm:ml-0 sm:w-auto w-full">
            <label for="account" class="text-sm text-gray-500 font-semibold ">Category</label>
            <x-form.white-select 
                wire:model="category"
                id="category" 
                name="category" 
                class="pl-2 pr-10 py-1.5 text-sm"
            >
                <option value="0">All</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </x-form.white-select >
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
    
        <x-dashboard.card x-show="kpi.account.balance" x-cloak>
            <x-slot:icon>
                <x-icons.scale-outline class="h-6 w-6 text-gray-400" />
            </x-slot>
            <dl>
                <dt class="truncate text-sm font-medium text-gray-500">
                    General balance
                </dt>
                <dd>
                    <div 
                        x-data="Money"
                        x-text="formated"
                        x-bind:data-amount="kpi.account.balance"
                        x-bind:data-currency-code="kpi.account.currency"
                        x-bind:data-currency-scale="kpi.account.currency_scale"
                        data-locale="{{ $locale['js'] }}"
                        class="text-lg font-medium text-gray-900"
                    >
                        $0,00
                    </div>
                </dd>
            </dl>
            <x-slot:foot>
                <a 
                    href="#" 
                    class="font-medium text-deep-dark hover:text-deep-dark"
                >
                    View all
                </a>
            </x-slot>
        </x-dashboard.card>

        <x-dashboard.card  x-show="kpi.account.period_balance" x-cloak>
            <x-slot:icon>
                <x-icons.check-circle-outline class="h-6 w-6 text-gray-400" />
            </x-slot>
            <dl>
                <dt class="truncate text-sm font-medium text-gray-500">
                    Period Balance (last 30 days)
                </dt>
                <dd>
                    <div
                        x-data="Money"
                        x-text="formated"
                        x-bind:data-amount="kpi.account.period_balance"
                        x-bind:data-currency-code="kpi.account.currency"
                        x-bind:data-currency-scale="kpi.account.currency_scale"
                        data-locale="{{ $locale['js'] }}"
                        class="text-lg font-medium text-gray-900"
                    >
                        $0,00
                    </div>
                </dd>
            </dl>
            <x-slot:foot>
                <a
                    href="#"
                    class="font-medium text-deep-dark hover:text-deep-dark"
                >
                    View all
                </a>
            </x-slot>
        </x-dashboard.card>


        <x-dashboard.card x-show="kpi.account.movements_count" x-cloak>
            <x-slot:icon>
                <x-icons.arrow-path-outline class="h-6 w-6 text-gray-400" />
            </x-slot>
            <dl>
                <dt
                    class="truncate text-sm font-medium text-gray-500"
                >
                    Transactions
                </dt>
                <dd>
                    <div
                        x-text="kpi.account.movements_count"
                        class="text-lg font-medium text-gray-900"
                    >
                        0
                    </div>
                </dd>
            </dl>
            <x-slot:foot>
                <a
                    href="#"
                    class="font-medium text-deep-dark hover:text-deep-dark"
                >
                    View all
                </a>
            </x-slot>
        </x-dashboard.card>
    </div>
</div>