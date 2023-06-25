<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use App\Support\Facades\Money;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public Account $account;

    public $currencies; 

    protected $rules = [
        'account.name' => 'required',
        'account.currency' => 'required',
        'account.balance' => 'required|numeric'
    ];

    public function mount()
    {
        $this->currencies = config('accountable.currencies');
        $this->account = new Account([
            'currency' => 'USD', 
            'balance' => null
        ]);
    }

    public function render()
    {
        return view('livewire.account.create')
                    ->layout('components.layouts.with-sidebar', [
                        'user' => Auth::user(),
                        'searchBar' => false
                    ]);
    }

    public function updated($propertyName, $value)
    {
        if($value) {
            $this->validateOnly($propertyName);
        }
    }

    public function create()
    {
        $account = new Account($this->validate()['account']);
        $account->balanceb = Money::of("$account->balance", $account->currency);
        $account->user()->associate(Auth::user());
        $account->save();
        return redirect()->route('home');
    }
}