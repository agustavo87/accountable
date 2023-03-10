<div>
    <div
        x-data="CreateCategoryModal({
            entangles:{
                open: @entangle('open').defer
            }
        })"
        x-on:keydown.window.escape="cancel"
        x-show="open"
        class="relative z-10"
        aria-labelledby="modal-title"
        x-ref="dialog"
        aria-modal="true"
        x-on:create-category.window="show"
        x-cloak
    >
        {{-- Background backdrop, show/hide based on modal state. --}}
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        ></div>
    
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div
                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
            >
                {{-- Modal panel, show/hide based on modal state. --}}
                <div
                    x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-md bg-white text-left shadow-xl transition-all flex-1 sm:my-8 sm:w-full sm:max-w-lg"
                    x-on:click.away="cancel"
                >
                    <h3 class="bg-deep-white font-semibold px-4 py-2 text-deep-dark tracking-wide uppercase">
                        Create Category
                    </h3>
                    <form wire:submit.prevent="create"> 
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <x-form.complex-text-input id="name" class="col-span-6 sm:col-span-3">
                                <x-slot:label>Name</x-slot>
                                <x-slot:input
                                    wire:model.defer="name"
                                    autocomplete="off"
                                    x-ref="categoryName"
                                >
                                </x-slot>
                            </x-form.complex-text-input>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 gap-2 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                            <x-primary-button type="submit" >
                                Create
                            </x-primary-button>
                            <x-tertiary-button
                                type="button"
                                x-on:click="cancel"
                            >
                                Cancel
                            </x-tertiary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 