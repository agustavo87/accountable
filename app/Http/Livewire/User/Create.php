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
        'user.name' => 'required|min:6',
        'user.email' => 'required|email',
        'password' => 'required|min:6'
    ];

    public function mount()
    {
        $this->user = new User();
    }

    public function render()
    {
        return view('livewire.user.create')
            ->layout('components.layouts.master', [
                'attributes' => ['class' => 'bg-gray-50']
            ]);
    }

    public function submit()
    {
        $this->user->password = Hash::make($this->password);
        $this->user->save();
        Auth::login($this->user);
        return redirect()->route('home');
    }
}
