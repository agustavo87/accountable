@props([
    'decimal' => '.',
    'thousands' => ','
])
@php
    if ($decimal == $thousands) {
        throw new Exception("Decimal '$decimal' and thousands '$thousands' can not be the same.", 1);
    }
@endphp
<div
    x-data="MoneyCurrencyGroupInput({
        amount: @entangle($amount->attributes->wire('model')),
        currency: @entangle($currency->attributes->wire('model')),
        currencyOptions: @entangle($currency->attributes->wire('options')),
        currencyHint: @entangle($currency->attributes->wire('hint')),
        errors: @entangle($attributes->wire('errors')),
        decimal: '{{ $decimal }}',
        thousands: '{{ $thousands }}',
    })"
    {{ $attributes }}
>
    <label for="{{ $amount->attributes['id'] }}" class="block text-sm font-medium text-gray-700">
        Balance
    </label>
    <div 
    wire:ignore {{-- We just ignore this part so the errors can be handled by livewire--}}
    class="money-container">
        <div class="money-currency-input-group">
            <input
                {{ $amount->attributes->whereDoesntStartWith('wire:model')->merge([
                    'name' => $amount->attributes['id'] ,
                    'type' => 'text',
                    'inputmode' => 'numeric',
                    'class' => "amount-input text-input sin-apariencia",
                    'placeholder' => "0.00",
                    'autocomplete' => "off",
                ])}}
                x-on:keydown="inputAmount($event)"
                x-on:blur="formatInput"
                x-ref="amount"
            >
            <div class="currency-input-container">
                <label for="{{ $currency->attributes['id'] ?? 'currency' }}" class="sr-only">Currency</label>
                <input 
                    {{ $currency->attributes->whereDoesntStartWith('wire:model')->merge([
                        'id' => $currency->attributes['id'] ?? 'currency',
                        'maxlength'=> "12",
                        'autocomplete' => 'off',
                        'class' => "currency-input"
                    ]) }}
                    x-ref="currencyInput"
                    x-on:input="currencyHint = $el.value"
                    x-on:focusin="
                        onCurrencyInput = true;
                        _currency = currency
                    "
                    x-on:focusout=" onCurrencyInput = false"
                    :class="hasCurrencyError && 'errored'"
                >
            </div>
            <div class="money-sign">
                <span>$</span>
            </div>
        </div>
        <ul
            x-show="showCurrencies"
            x-on:mouseenter="onCurrenciesList = true"
            x-on:mouseleave="onCurrenciesList = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0 "
            x-transition:leave-end="opacity-0 -translate-y-2"
            x-cloak
            class="absolute z-10 py-1 max-h-60 w-full overflow-auto rounded-b-md bg-white shadow-md transform text-base focus:outline-none sm:text-sm"
            id="options" role="listbox"
        >
            <template x-for="cy in currencyOptions" x-bind:key="cy.code">
                <li
                    :data-code="cy.code"
                    @click="setCurrency($el.dataset.code)"
                    class="relative flex justify-between cursor-pointer select-none py-2 px-3 text-gray-700 hover:text-white hover:bg-indigo-600"
                    role="option" 
                >
                    <span class="block truncate opacity-60" x-text="cy.name"></span>
                    <span class="block truncate font-semibold" x-text="cy.code"></span>
                </li>
            </template>
            <li x-show="currencyOptions.length == 0" class="px-3 py-2 text-gray-400">Nothing found</li>
        </ul>
    </div>
    <div>
        {{ $errors }}
    </div>
</div>