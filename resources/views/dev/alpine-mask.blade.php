<x-layouts.master>
    <div 
        x-data
        class="p-5 w-80 flex gap-2 items-center"
    >
        <label for="some-money" class="font-medium gray-700">
            Money:
        </label>
        <input 
            type="text" 
            id="some-money"
            class="px-2 py-1-rounded border shadow" 
            x-mask:dynamic="$money($input)" 
            placeholder="0.00"
        >
    </div>
</x-layouts.master>
