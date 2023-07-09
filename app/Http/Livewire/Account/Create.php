<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use App\Support\Facades\Money;
use App\Values\CurrencyType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public Account $account;

    public $currencies; 

    public $accountName;

    public $accountBalance;

    protected $rules = [
        'accountName' => 'required',
        'accountBalance' => 'required|numeric',
        'currency'      => 'required|string'
    ];

    public $currency = 'USD';

    public function mount()
    {
        $this->currencies = config('accountable.currencies');
        $this->account = new Account();
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
        $data = $this->validate();
        $account = new Account();
        $account->name = $data['accountName'];
        $account->balance = Money::from(CurrencyType::Fiat)->of("{$data['accountBalance']}", $this->currency);
        $account->user()->associate(Auth::user());
        $account->save();
        return redirect()->route('home');
    }
}