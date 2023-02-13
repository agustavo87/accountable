<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class RecentActivity extends Component
{
    use WithPagination;

    public $operations;

    public $pagination;

    public $account = 0;

    public $category;

    protected $queryString = [
        'account' => ['except' => 0], 
        'category' => ['except' => 0]
    ];

    protected $listeners = [
        'account-update' => 'updateAccount',
        'category-update' => 'updateCategory'
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->fetchOperations();
    }

    public function updatedAccount()
    {
        $this->resetPage();
        $this->fetchOperations();
    }

    public function updatedCategory()
    {
        $this->resetPage();
        $this->fetchOperations();
    }

    public function updatedPage()
    {
        $this->fetchOperations();
    }

    public function updateAccount($id)
    {
        $this->account = $id;
        $this->updatedAccount($id);
    }

    public function updateCategory($id)
    {
        $this->category = $id;
        $this->updatedCategory($id);
    }

    public function fetchOperations()
    {
        /** @var Builder */
        $query = Operation::where('user_id', Auth::id())
                           ->with(['movements.account', 'category'])
                           ->withCount('movements');

        $query->when($this->category, function(Builder $query, $category) {
            $query->where('category_id', $category);
        });

        $query->when($this->account, function(Builder $query, $account) {
            $query->whereHas('movements', function(Builder $query) use ($account) {
                $query->where('account_id', $account);
            });
        });
        
        $results = $query->orderBy('created_at', 'desc')
            ->simplePaginate(5)->toArray();
        $this->operations = $results['data'];
        unset($results['data']);
        $this->pagination = $results;
    }

    public function render()
    {
        return view('livewire.dashboard.recent-activity');
    }
}
