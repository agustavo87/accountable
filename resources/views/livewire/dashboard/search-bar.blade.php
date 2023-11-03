<form
    x-data="{
        search:'',
        fetch: function() {
            this.$wire.emit('{{$eventName}}', this.search)
        }
    }"
    x-on:submit.prevent
    class="flex w-full md:ml-0"
>
    <label for="search-field" class="sr-only">Search</label>
    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
        <div
            class="pointer-events-none absolute inset-y-0 left-0 flex items-center"
            aria-hidden="true"
        >
            <x-icons.mini-magnifying-glass class="h-5 w-5" />
        </div>
        <input
            x-model="search"
            x-on:change.debouce="fetch"
            name="search-field"
            id="search-field"
            placeholder="{{$placeholder}}"
            class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
            type="search"
        />
    </div>
</form>