<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    public bool $remember = true;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.user.login')
                ->layout('components.layouts.master', [
                    'attributes' => ['class' => 'min-h-full bg-gradient-to-t from-gray-100 to-white']
                ]);
    }

    public function submit()
    {
        $credentials = $this->validate();
        if(!Auth::attempt($credentials, $this->remember)) {
            return $this->addError('email', 'The provided credentials don\'t match our records.');
        }
        
        return redirect()->intended();
    }
}
