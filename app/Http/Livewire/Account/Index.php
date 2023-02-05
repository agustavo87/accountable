<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $accounts;

    public function mount()
    {
        $this->accounts = Auth::user()->accounts()->withCount('movements')->get();
    }
    
    public function render()
    {
        return view('livewire.account.index');
    }
}