<div class="bg-gray-100">
    <div class="mx-auto max-w-6xl py-6 sm:px-6 lg:px-8">
        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Profile settings
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Specify information of the account.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form wire:submit.prevent="save">
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                <div class="flex flex-col items-stretch sm:flex-row gap-10 sm:gap-5 mb-3">
                                    <div class="flex-auto flex flex-col sm:max-w-sm gap-5">
                                        <div class="grid grid-cols-3 gap-6">
                                            <x-form.input id="name" class="modifyable-content-input col-span-3">
                                                <x-slot:label
                                                    @class([
                                                        'transition h-5 flex items-end',
                                                        'font-normal text-xs leading-3 text-gray-400' => !$modifying
                                                    ])
                                                >Name</x-slot>
                                                <x-slot:input
                                                    autocomplete="name"
                                                    required=""
                                                    wire:model.defer="user.name"
                                                    :disabled="!$modifying"
                                                ></x-slot>
                                            </x-form.input>
                                        </div>
                                        <div class="grid grid-cols-3 gap-6">
                                            <x-form.input id="email" class="modifyable-content-input col-span-3" >
                                                <x-slot:label
                                                    @class([
                                                        'transition h-5 flex items-end',
                                                        'font-normal text-xs leading-3 text-gray-400' => !$modifying
                                                    ])
                                                >Email address</x-slot>
                                                <x-slot:input
                                                    type="email"
                                                    autocomplete="email"
                                                    required=""
                                                    wire:model.defer="user.email"
                                                    :disabled="!$modifying"
                                                ></x-slot>
                                            </x-form.input>
                                        </div>
                                    </div>
                                    <div class="flex flex-row sm:flex-col flex-1 min-w-max justify-around sm:justify-center items-center sm:items-center gap-3">
                                        <div class="flex flex-col gap-2 justify-start items-center">
                                            <img
                                                class="h-16 w-16 rounded-full border-4 border-gray-30"
                                                src="{{$avatarUpload ? $avatarUpload->temporaryUrl() : $user->avatar_url }}"
                                                alt="Avatar"
                                            />
                                            <div class="flex gap-2 items-center justify-center">
                                                <label for="avatar" class="link font-semibold text-xs cursor-pointer">Change Avatar</label>
                                                @if($avatarUpload)
                                                    <button 
                                                        wire:click="saveAvatar" 
                                                        type="button" 
                                                        class="btn-rounded"
                                                    >
                                                        <x-icons.check class="h-5 w-5" />
                                                    </button>
                                                @endif
                                            </div>
                                            <input class="sr-only" wire:model="avatarUpload" type="file" name="avatar" id="avatar">
                                            
                                        </div>
                                        <x-tertiary-button x-on:click="$dispatch('change-password')" type="button" class="bg-white mt-2">
                                            Change Password
                                        </x-tertiary-button>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end items-center">
                                <div
                                    x-on:text-notification.window="
                                        notification = $event.detail; 
                                        window.setTimeout(() => show = true, 50); 
                                        window.setTimeout(() => show = false, 3050)
                                    "
                                    x-data="{notification:'', show:false}"
                                    class="text-sm font-semibold text-gray-500 mx-5"
                                >
                                    <span x-show="show" x-text="notification" x-transition.opacity.duration.400ms></span>
                                </div>
                                @if($modifying)
                                    <div class="flex gap-2 justify-end">
                                        <x-tertiary-button type="button" wire:click="cancel">
                                            Cancel
                                        </x-tertiary-button>
                                        <x-primary-button type="submit">
                                            Save
                                        </x-primary-button>
                                    </div>
                                @else
                                    <x-primary-button type="button" wire:click="edit">
                                        Edit
                                    </x-primary-button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('modals')
    <livewire:user.change-password />
@endpush