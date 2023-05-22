<?php

namespace App\Http\Livewire;

use App\Models\CryptoCurrency;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MoneyAndCurrencyInputGroup extends Component
{
    public $currencyOptions;

    public $currency;

    public ?string $currencyHint = null;

    public $amount;

    public $errors;

    protected $rules = [
        'amount' => 'required',
        'currency' => 'required'
    ];

    public function mount()
    {
        $this->fetchData();
    }

    public function updatedCurrencyHint($value)
    {
        $this->fetchData();
    }

    protected function fetchData()
    {
        $this->currencyOptions = CryptoCurrency::query()
            ->when($this->currencyHint, function (Builder $query, $value) {
                return $query->where('code', 'LIKE', "%$value%");
            })
            ->take(5)
            ->get()
            ->toArray();
    }

    public function render()
    {
        $this->errors = $this->getErrorBag()->toArray();
        return view('livewire.money-and-currency-input-group');
    }

    public function submit()
    {
        $this->validate();
    }
}
