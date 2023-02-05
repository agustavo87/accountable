<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.user.login');
    }

    public function submit()
    {
        $credentials = $this->validate();
        Auth::attempt($credentials);
        
        return redirect()->intended();
    }
}
