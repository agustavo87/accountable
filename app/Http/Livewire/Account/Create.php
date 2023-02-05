<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public Account $account;

    protected $rules = [
        'account.name' => 'required',
        'account.currency' => 'required',
        'account.balance' => 'required'
    ];

    public function mount()
    {
        $this->account = new Account([
            'currency' => 'USD', 
            'balance' => 0.0
        ]);
    }

    public function render()
    {
        return view('livewire.account.create');
    }

    public function create()
    {
        $account = new Account($this->validate()['account']);
        $account->user()->associate(Auth::user());
        $account->save();
        return redirect()->route('account.index');
    }
}