@props([
    'id'
])
<div {{ $attributes }}>
    <label for="{{ $id }}"
        class="block text-sm font-medium text-gray-700">Balance</label>
    <div class="money-container flex relative rounded-md shadow-sm">
        <input id="{{ $id }}" {{ $input->attributes->merge([
            'name' => $id,
            'type' => 'number',
            'class' => "text-input sin-apariencia pl-7 pr-12",
            'placeholder' => "0.00",
            'autocomplete' => "off"
        ])}} >
        <div class="absolute inset-y-0 right-0 flex items-center">
            <label for="currency" class="sr-only">Currency</label>
            <select wire:model="account.currency"  id="currency" name="currency"
                class="select mt-0 shadow-none bg-transparent border-transparent py-0 pl-2 pr-7 hover:bg-transparent hover:border-transparent focus:border-transparent focus:bg-transparent">
                {{ $currencies }}
            </select>
        </div>
        <div class="money-sign pointer-events-none absolute inset-y-0 left-0 flex  items-center pl-3">
            <span class="money-sign">$</span>
        </div>
    </div>
    <x-error for="{{ $input->attributes->wire('model')->value() }}" />
    <x-error for="{{ $currencies->attributes->wire('model')->value() }}" />
</div>