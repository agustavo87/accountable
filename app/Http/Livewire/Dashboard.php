<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = Auth::user();

    }
    public function render()
    {
        return view('livewire.dashboard')
                ->layout("components.layouts.with-sidebar", [
                    'user' => $this->user
                ]);
    }
}
