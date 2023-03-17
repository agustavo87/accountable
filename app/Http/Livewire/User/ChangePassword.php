<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $open = false;

    public $old_password = '';

    public $password = '';

    public $password_confirmation = '';

    public $rules = [
        'old_password' => 'required|current_password',
        'password' => 'required|confirmed|min:5|max:100',
        'password_confirmation' => 'required'
    ];
    
    public function render()
    {
        return view('livewire.user.change-password');
    }

    public function change()
    {
        $this->validate();
        /** @var User  */
        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();
        $this->open = false;
        $this->dispatchBrowserEvent('text-notification', 'Password Changed!');
    }
}
