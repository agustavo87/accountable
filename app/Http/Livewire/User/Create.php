<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Hash};
use Livewire\Component;

class Create extends Component
{
    public User $user;

    public $password;

    protected $rules = [
        'user.name' => 'required|min:6|max:200',
        'user.email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|max:200'
    ];

    public function mount()
    {
        $this->user = new User();
    }

    public function render()
    {
        return view('livewire.user.create')
            ->layout('components.layouts.master', [
                'attributes' => ['class' => 'min-h-full bg-gradient-to-t from-gray-100 to-white']
            ]);
    }

    public function submit()
    {
        $this->validate();
        $this->user->password = Hash::make($this->password);
        $this->user->save();
        Auth::login($this->user);
        return redirect()->route('home');
    }
}
