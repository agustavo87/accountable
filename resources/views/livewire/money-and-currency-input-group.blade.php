<form wire:submit.prevent="submit">
    <ul>
        <li>
            Currency: {{ $currency }}
        </li>
        <li>
            Amount: {{ $amount}}
        </li>
    </ul>
    <x-form.money-currency-group-input 
        lang="en"
        wire:errors="errors" 
    >
        <x-slot:amount
            id="amount" 
            wire:model.defer="amount"
        ></x-slot>
        <x-slot:currency
            wire:model="currency"
            wire:options="currencyOptions"
            wire:hint="currencyHint"
            placeholder="..."
        ></x-slot>
        <x-slot:errors>
            <x-error for="amount" class="mt-0.5" />
            <x-error for="currency" class="mt-0.5" />
        </x-slot>
    </x-form.money-currency-group-input >
    <x-form.primary-button class="mt-1">Mandar</x-form.button>
</form>
