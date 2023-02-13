<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overview extends Component
{
    public $accounts;

    public $account;

    public $categories;

    public $category;

    public $kpi;
    
    public function mount()
    {
        $user = Auth::user();
        $this->accounts = $user->accounts()->get(['id', 'name']);
        $this->account = request('account',0);

        $this->categories = $user->operationCategories()->get(['id', 'name']);
        $this->category = request('category',0);

        $this->fetchKPI();
    }

    protected function fetchKPI()
    {
        if(!$this->account) {
            $this->kpi = $this->nullKPI();
            return;
        }

        /** @var Collection */
        $data = Auth::user()->operations()
            ->when(
                $this->category,
                fn(Builder $query, $category) => $query->where('category_id', $category)
            )
            ->when(
                $this->account,
                fn(Builder $query, $account) => $query->whereHas(
                    'movements', 
                    fn(Builder $query) => $query->where('account_id', $this->account)
                )
            )
            ->with('movements')
            ->withCount('movements')
            ->get();

        $moves = $data->map(fn ($model) => $model->movements)
                      ->flatten(1)
                      ->where('account_id', $this->account);;

        if(!($account = $moves->first()?->account)) {
            $account = Account::find($this->account);
            $debit = $credit = 0;
        } else {
            $debit = $moves->where('type', 0)->sum('amount');
            $credit = $moves->where('type', 1)->sum('amount');
        }


        $this->kpi = [
            'account' => [
                'balance' => $account->balance,
                'movements' => $moves->count(),
                'currency' => $account->currency,
                'debit' => $debit,
                'credit' => $credit,
                'period_balance' => $credit - $debit
            ]
        ];
    }

    protected function nullKPI()
    {
        return [
            'account' => [
                'balance' => null,
                'movements' => null,
                'currency' => null,
                'debit' => null,
                'credit' => null,
                'period-balance' => null
            ]
        ];
    }

    protected function updatedAccount($value)
    {
        $this->fetchKPI();
        $this->emit('account-update',$value);
    }

    protected function updatedCategory($value)
    {
        $this->fetchKPI();
        $this->emit('category-update',$value);
    }

    public function render()
    {
        return view('livewire.dashboard.overview');
    }
}
