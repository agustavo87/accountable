<?php

namespace App\Http\Livewire\Operation;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $operations;

    public $account;

    public $accounts;
    
    public $categories;

    public $category;

    protected $queryString = [
        'account' => ['except' => ''], 
        'category' => ['except' => '']
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->accounts = $user->accounts()->get(['id', 'name'])->toArray();
        $this->categories = $user->operationCategories()->get(['id', 'name'])->toArray();
        $this->fetchOperations();
    }

    public function updatedAccount()
    {
        $this->fetchOperations();
    }

    public function updatedCategory()
    {
        $this->fetchOperations();
    }

    public function fetchOperations()
    {
        /** @var Builder */
        $query = Operation::where('user_id', Auth::id())
                           ->with('movements.account');

        $query->when($this->category, function(Builder $query, $category) {
            $query->where('category_id', $category);
        });

        $query->when($this->account, function(Builder $query, $account) {
            $query->whereHas('movements', function(Builder $query) use ($account) {
                $query->where('account_id', $account);
            });
        });
        
        $this->operations = $query->get();
    }

    public function render()
    {
        return view('livewire.operation.index');
    }
}
