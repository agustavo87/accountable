@props([
    'lang' => 'en',
    'label' => 'balance'
])
<div
    x-data="MoneyInputComponent({
        amount: @entangle($amount->attributes->wire('model')),
        currencyParameters: @entangle($attributes->wire('parameters')),
        lang: '{{$lang}}',
    })"
    {{$attributes->whereDoesntStartWith('wire:model') }}
>
    <label for="{{ $amount->attributes['id'] }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <div 
        {{-- We just ignore this part so the errors can be handled by livewire--}}
        wire:ignore 
        class="money-container"
    >
        <div class="money-currency-input-group">
            <input
                {{ $amount->attributes->whereDoesntStartWith('wire:model')->merge([
                    'name' => $amount->attributes['id'] ,
                    'type' => 'text',
                    'inputmode' => 'numeric',
                    'class' => "amount-input text-input sin-apariencia",
                    'autocomplete' => "off",
                ])}}
                x-bind:placeholder="placeholder"
                x-on:keydown="inputAmount($event)"
                x-on:blur="formatInput"
                x-ref="amount"
            >
            <div class="currency-code-container">
                <span
                    class="currency-code"
                    x-text="currencyParameters.code"
                >USD</span>
            </div>
            <div class="money-sign">
                <span>$</span>
            </div>
        </div>
    </div>
    <div>
        {{ $errors }}
    </div>
</div>