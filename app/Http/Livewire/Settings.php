<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public User $user;

    public $modifying = false;

    public $avatarUpload = null;

    protected function rules()
    {
        return [
            'user.name' => 'required|min:6|max:200',
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id)
            ],
            'avatarUpload' => 'nullable|sometimes|image|max:1000',
        ];
    }

    public function mount()
    {
       $this->getUser();
    }

    public function render()
    {
        return view('livewire.settings')
                ->layout('components.layouts.with-sidebar', [
                    'user' => $this->user,
                    'searchBar' => false
                ]);
    }

    public function edit()
    {
        $this->modifying = !$this->modifying;
    }
    public function cancel()
    {
        $this->modifying = false;
        $this->getUser();
    }

    public function getUser()
    {
        $this->user = Auth::user();
    }

    public function updatedAvatarUpload()
    {
        $this->validateOnly('upload');
    }

    public function saveAvatar()
    {
        $filename = $this->avatarUpload->store('/', 'avatars');
        $this->user->avatar = $filename;
        $this->user->save();
        $this->emit('profile-updated');
        $this->avatarUpload = null;
    }

    public function save()
    {
        $this->validate();
        $this->user->save();
        $this->modifying = false;
        $this->dispatchBrowserEvent('text-notification', 'Saved!');
        $this->emit('profile-updated');
    }
}
