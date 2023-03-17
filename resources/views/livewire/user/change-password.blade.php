<div>
    <div
        x-data="{
            open: @entangle('open'),
            show: function () {
                this.open = true;
            },
            close: function () {
                this.open = false
            },
            cancel: function () {
                this.open = false
            }
        }"
        x-on:keydown.window.escape="cancel"
        x-show="open"
        class="relative z-10"
        aria-labelledby="modal-title"
        x-ref="dialog"
        aria-modal="true"
        x-on:change-password.window="show"
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
                    class="relative transform overflow-hidden rounded-md bg-white text-left shadow-xl transition-all flex-1 sm:my-8 sm:w-full sm:max-w-sm"
                    x-on:click.away="cancel"
                >
                    <h3 class="bg-deep-white font-semibold px-4 py-2 text-deep-dark tracking-wide uppercase">
                        Change Password
                    </h3>
                    <form wire:submit.prevent="change"> 
                        <div class="bg-white pb-8 pt-4 px-4 sm:p-7 sm:pb-10">
                            <div class="grid grid-cols-6 gap-5">
                                <x-form.input id="password" class="col-span-6">
                                    <x-slot:label>Current Password</x-slot>
                                    <x-slot:input
                                        wire:model.defer="old_password"
                                        type="password"
                                        autocomplete="password"
                                        required=""
                                    ></x-slot>
                                </x-form.input>
                                <x-form.input id="new_password" class="col-span-6">
                                    <x-slot:label>New Password</x-slot>
                                    <x-slot:input
                                        wire:model.defer="password"
                                        type="password"
                                        required=""
                                    ></x-slot>
                                </x-form.input>
                                <x-form.input id="password_confirmation" class="col-span-6">
                                    <x-slot:label>Repeat New Password</x-slot>
                                    <x-slot:input
                                        wire:model.defer="password_confirmation"
                                        type="password"
                                        required=""
                                    ></x-slot>
                                </x-form.input>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 gap-2 sm:flex sm:flex-row-reverse sm:px-6"
                        >
                            <x-primary-button type="submit" >
                                Change
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