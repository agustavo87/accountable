<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dropdown extends Component
{
    public User $user;

    protected $listeners = ['profile-updated' => 'fetch'];

    public function mount(?User $user = null)
    {
        if($user) {
            $this->user = $user;
            return;
        }
        $this->fetch();
    }

    public function fetch()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.user.dropdown');
    }
}
