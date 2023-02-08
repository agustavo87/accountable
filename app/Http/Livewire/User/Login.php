<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    public bool $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.user.login')
                ->layout('components.layouts.master', [
                    'attributes' => ['class' => 'bg-gray-50']
                ]);
    }

    public function submit()
    {
        $credentials = $this->validate();
        Auth::attempt($credentials, $this->remember);
        
        return redirect()->intended();
    }
}
