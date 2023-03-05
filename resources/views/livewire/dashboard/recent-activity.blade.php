 <div 

 >
    {{-- List in small --}}
     <div 
        class="sm:hidden"
        :class="operations.length > 0 ? 'shadow' : ''"
        wire:ignore
        x-data="OperationsList({
            entangles:{
                operations: @entangle('operations'),
                pagination: @entangle('pagination')
            },
            locale: '{{$locale['js']}}'
        })"
    >
        <div x-show="operations.length > 0">
            
            <ul
                wire:ignore
                role="list"
                class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden"
            >
                <template x-for="operation in operations">
                        <li>
                            <a
                                href="#"
                                class="block bg-white px-4 py-4 hover:bg-gray-50"
                            >
                                <span class="flex items-center space-x-4">
                                    <span
                                        class="flex flex-1 space-x-2 truncate"
                                    >
                                        {{-- Heroicon name: mini/banknotes --}}
                                        <svg
                                            class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        <span
                                            class="flex flex-col truncate text-sm w-full text-gray-500"
                                        >
                                            <span class="truncate font-semibold"
                                                x-text="operation.name"
                                                >
                                                Payment to Molly Sanders
                                            </span>
                                            <template x-for="movement in operation.movements">
                                                <div class="flex justify-between">
                                                    <span x-text="movement.account.name"></span>
                                                    <span class="opacity-80" :class="movement.type == 0 ? 'text-red-800' : 'text-green-800'">
                                                        <span
                                                            class="font-medium"
                                                            x-text="(movement.type == 0 ? '-' : '' ) + formatNumber(movement.amount, movement.account.currency)"
                                                            >$20,000</span>
                                                        <span
                                                            x-text="movement.account.currency"
                                                        >
                                                            USD
                                                        </span>
                                                    </span>
                                                </div>
                                            </template>
                                            <time :datetime="operation.date_string"
                                                :text="operation.date"
                                                class="opacity-80"
                                                >July 11, 2020</time
                                            >
                                        </span>
                                    </span>
                                    {{-- Heroicon name: mini/chevron-right --}}
                                    <svg
                                        class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </span>
                            </a>
                        </li>
                    </template>
            </ul>
        
            <nav
                class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3"
                aria-label="Pagination"
            >  
                <div class="flex flex-1 justify-between">
                    <button
                        wire:click="previousPage"
                        :disabled="!pagination.prev_page_url"
                        type="button"
                        :class="pagination.prev_page_url ? 'hover:text-gray-500' : 'opacity-70 cursor-default'"
                        class="relative inline-flex items-center rounded-bl-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700"
                        >Previous</button
                    >
                    <button
                        type="button"
                        wire:click="nextPage" 
                        :disabled="!pagination.next_page_url"
                        :class="pagination.next_page_url ? 'hover:text-gray-500' : 'opacity-70 cursor-default'"
                        class="relative ml-3 inline-flex items-center rounded-br-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500"
                        >Next</button
                    >
                </div>
            </nav>

        </div>

        <div x-show="operations.length < 1" class="flex items-center justify-center py-10">
            <p class="text-sm text-gray-700 font-semibold" >No operations found.</p>
        </div>

    </div>
    
    {{-- <!-- Activity table (small breakpoint and up) --> --}}
    <div class="hidden sm:block">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mt-2 flex flex-col">
                <div
                    wire:ignore
                    x-data="OperationsTable({
                        entangles: {
                            operations: @entangle('operations'),
                            pagination: @entangle('pagination')
                        },
                        locale: '{{$locale['js']}}'
                    })"
                    class="min-w-full overflow-hidden overflow-x-auto align-middle sm:rounded-lg"
                    :class="operations.length > 0 ? 'shadow' : ''"
                >
                    <div x-show="operations.length > 0">

                        <table
                            class="min-w-full"
                        >
                            <thead class=" border-b border-gray-200 ">
                                <tr>
                                    <th
                                        class="hidden md:block bg-gray-50 px-6 py-3 text-sm font-semibold text-gray-900 border-0"
                                        scope="col"
                                    >
                                        Date
                                    </th>
                                    <th
                                        class="bg-gray-50 px-6 py-3  text-sm font-semibold text-gray-900 border-0"
                                        scope="col"
                                    >
                                        Category
                                    </th>
                                    <th
                                        class="bg-gray-50 px-6 py-3 text-sm font-semibold text-gray-900 border-0"
                                        scope="col"
                                    >
                                        Operation
                                    </th>
                                                                    <th
                                        class="bg-gray-50 px-6 py-3 text-sm font-semibold text-gray-900 border-0"
                                        scope="col"
                                    >
                                        Transaction
                                    </th>
                                    <th
                                        class="bg-gray-50 px-6 py-3 text-right text-sm font-semibold text-gray-900 border-0"
                                        scope="col"
                                    >
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class=" bg-white"
                                
                            >
                                <template x-for="(operation, opIndex) in operations">
                                    <template x-for="(movement, moveIndex) in operation.movements">
                                        <tr class="bg-white" >
                                            <td
                                                x-bind:class="border(moveIndex, opIndex, operation) ? 'border-b': ''"
                                                class="hidden md:table-cell whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500 opacity-80"
                                            >
                                                <time 
                                                    x-text="moveIndex <= 0 ? operation.date : '' "
                                                    x-bind:datetime="operation.date_string"
                                                    ></time
                                                >
                                            </td>
                                            <td
                                                x-text="moveIndex <= 0 ? operation.category.name : ''"
                                                x-bind:class="border(moveIndex, opIndex, operation) ? 'border-b': ''"
                                                class="  whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                            >
                                            </td>
                                            <td
                                                x-bind:class="border(moveIndex, opIndex, operation) ? 'border-b': ''"
                                                class="  w-full max-w-0 whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                            >
                                                    <div
                                                        class="text-gray-600 font-semibold"
                                                        x-text="moveIndex <= 0 ? operation.name : '' "
                                                        >
                                                    </div>
                                            </td>
            
                                            <td
                                                x-bind:class="border(moveIndex, opIndex, operation) ? 'border-b': ''"
                                                class=" whitespace-nowrap px-6 py-4 text-left text-sm text-gray-500"
                                            >
                                                <div 
                                                    class="text-gray-700"
                                                    x-text="movement.account.name"
                                                ></div>
                                                <div 
                                                    class="italic text-gray-500 text-xs"
                                                    x-text="movement.note"
                                                ></div>
                                                
                                            </td>
                                            <td
                                                x-bind:class="{
                                                    'border-b': border(moveIndex, opIndex, operation),
                                                    'text-green-800': movement.type == 1,
                                                    'text-red-800': !(movement.type == 1)
                                                }"
                                                class=" opacity-90  whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500"
                                            >
                                                <span
                                                    class="font-medium"
                                                    x-text="(movement.type == 0 ? '-' : '') + formatNumber(movement.account.currency, movement.amount)"
                                                    ></span
                                                > 
                                                <span x-text="movement.account.currency"></span>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav
                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-5"
                            aria-label="Pagination"
                        >
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <!-- space -->
                                    <span class="font-medium"
                                        x-text="pagination.from"
                                        ></span
                                    >
                                    <!-- space -->
                                    to
                                    <!-- space -->
                                    <span class="font-medium"
                                        x-text="pagination.to"
                                        ></span
                                    >
                                </p>
                            </div>
                            <div
                                class="flex flex-1 justify-between sm:justify-end"
                            >
                                <button
                                    wire:click="previousPage"
                                    type="button"
                                    class="relative inline-flex items-center rounded-none border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700"
                                    x-bind:class="{
                                        'hover:bg-gray-50': pagination.prev_page_url,
                                        'opacity-60 cursor-default': !pagination.prev_page_url
                                    }"
                                    x-bind:disabled="!pagination.prev_page_url"
                                    >Previous</a
                                >
                                <button
                                    wire:click="nextPage" 
                                    type="button"
                                    class="relative ml-3 inline-flex items-center rounded-br-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700"
                                    x-bind:class="{
                                        'hover:bg-gray-50': pagination.next_page_url,
                                        'opacity-60 cursor-default': !pagination.next_page_url
                                    }"
                                    x-bind:disabled="!pagination.next_page_url"                             
                                    >Next</a
                                >
                            </div>
                        </nav>
                    
                    </div> 
                    <div x-show="operations.length < 1" class="flex items-center justify-center py-16">
                        <p class="text-sm text-gray-700 font-semibold" >No operations found.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
