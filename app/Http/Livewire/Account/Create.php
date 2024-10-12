<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use App\Models\ISOCurrency;
use App\Repositories\Currency\Crypto;
use App\Repositories\Currency\Factory as CurrencyRepositoryFactory;
use App\Repositories\Currency\Fiat;
use App\Support\Facades\Money;
use App\Values\CurrencyType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    /**
     * Account to be created
     */
    public Account $account; 

    public $accountName;

    public $accountBalance;

    protected $rules = [
        'accountName' => 'required',
        'accountBalance' => 'required|numeric|min:0',
        'currencyCode'      => 'required|string',
    ];

    public $cryptoCurrencyOptions;
    public $currencyOptions;

    public $currencyCode;
    public $currencyType;

    public ?string $currencyHint = null;

    public array $currencyParameters = [];

    public $errors;

    public $locale;

    public function mount()
    {
        $this->locale = config('app.locale');
        $this->currencyCode = config('accountable.currencies.default');
        $this->currencyType = CurrencyType::Fiat->stringCode();
        $this->currencyHint = $this->currencyCode;
        $this->fetchCurrencies();
        $this->setCurrencyParameters($this->currencyCode);
        $this->account = new Account();
    }

    public function updatedCurrencyHint($value)
    {
        $this->fetchCurrencies();
    }

    protected function fetchCurrencies()
    {
        $this->currencyOptions = (new Fiat())->search('code', $this->currencyHint, 5);
        $this->cryptoCurrencyOptions = (new Crypto())->search('code', $this->currencyHint, 5);
    }

    protected function setCurrencyParameters($charCode)
    {
        $this->currencyParameters = Money::currencies(
                CurrencyType::fromStringCode($this->currencyType)
            )->get($charCode)->toArray();
    }

    public function render()
    {
        $this->errors = $this->getErrorBag()->toArray();
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
            if($propertyName == 'currencyCode') {
                $this->setCurrencyParameters($value);
            }
        }
    }

    public function create()
    {
        $data = $this->validate();
        $account = new Account();
        $account->name = $data['accountName'];
        $account->balance = Money::of("{$data['accountBalance']}", $this->currencyCode);
        $account->user()->associate(Auth::user());
        $account->save();
        return redirect()->route('home');
    }
}