<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Account;
use App\Support\Facades\Money;
use App\Values\CurrencyType;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        // Currently 'account' and 'category' query strings are managed by the
        // RecentActivity Livewire component.
        $this->account = request('account',0);
        $this->category = request('category',0);

        $user = Auth::user();
        $this->accounts = $user->accounts()->get(['id', 'name']);
        $this->categories = $user->operationCategories()->get(['id', 'name']);

        $this->fetchKPI();
    }

    protected function fetchKPI()
    {
        if(!$this->account) {
            $this->kpi = $this->nullKPI();
            return;
        }

        /** @var Account */
        $account = Account::find($this->account);

        $overview = DB::table('movements')->selectRaw("
                SUM(movements.minor_amount) as total_minor_amount, 
                COUNT(movements.id) as `movements_count`,
                CASE 
                    when movements.type = 0 then 'debit'
                    when movements.type  = 1 then 'credit'
                END AS type
            ")
            ->where('movements.account_id', $account->id)
            ->when(
                $this->category, 
                function (Builder $query, $category) {
                    $query->leftJoin('operations', 'movements.operation_id', '=', 'operations.id')
                          ->where('operations.category_id', $category);
                }
            )
            ->groupBy('movements.type')
            ->get()
            ->keyBy('type');

        foreach (['debit', 'credit'] as $type) {
            $overview[$type] = (object) [
                'total' => Money::from(CurrencyType::from($account->balance_currency_type))->ofMinor(
                    $overview->has($type) ? $overview[$type]->total_minor_amount : 0,
                    $account->balance_currency_number
                ),
                'type'  => $type,
                'movements_count' => $overview->has($type) ? $overview[$type]->movements_count : 0
            ];
        }

        $this->kpi = [
            'account' => [
                'balance' => $account->balance->getDecimalAmount(),
                'movements_count' => $overview->sum('movements_count'),
                'currency' => $account->balance->getCurrency()->getCurrencyCode(),
                'currency_scale' => $account->balance->getCurrency()->getDefaultFractionDigits(),
                'debit' => $overview['debit']->total->getDecimalAmount(),
                'credit' => $overview['credit']->total->getDecimalAmount(),
                'period_balance' => $overview['credit']->total->minus($overview['debit']->total)->getDecimalAmount()
            ]
        ];
    }

    protected function nullKPI()
    {
        return [
            'account' => [
                'balance' => null,
                'movements_count' => null,
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
