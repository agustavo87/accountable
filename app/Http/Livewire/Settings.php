<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Settings extends Component
{
    public User $user;

    public $modifying = false;

    protected function rules()
    {
        return [
            'user.name' => 'required|min:6|max:200',
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id)
            ],
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

    public function save()
    {
        $this->validate();
        $this->user->save();
        $this->modifying = false;
        $this->dispatchBrowserEvent('text-notification', 'Saved!');
        $this->emit('profile-updated');
    }
}
