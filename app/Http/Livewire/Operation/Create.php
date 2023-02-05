<?php

namespace App\Http\Livewire\Operation;

use App\Models\Account;
use App\Models\Movement;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public EloquentCollection $accounts;
    
    public EloquentCollection $categories;

    public $category;

    public Operation $operation;

    public Movement $movement;

    public array $movements = [];

    protected $operationRules = [
        'operation.name' => ['required'],
        'operation.notes' => ['sometimes'],
    ];

    protected $movementRules = [
        'movement.account_id' => ['required'],
        'movement.type' => ['required'],
        'movement.note' => ['sometimes'],
        'movement.amount' => ['required']
    ];

    protected function getRules()
    {
        return $this->operationRules + $this->movementRules;
    }

    public function mount()
    {
        $user = Auth::user();
        $this->accounts = $user->accounts ?? new EloquentCollection() ;

        $this->categories = $user->operationCategories ?? new EloquentCollection();
        $this->operation = new Operation();
        $this->newMovement();
        if(count($this->categories)) {
            $this->category = $this->categories->first()->id;
        }
    }

    public function commitMovement()
    {
        $this->validate($this->movementRules);
        $this->movements[] = $this->movement->load('account')->toArray();
        $this->newMovement();
    }

    protected function newMovement()
    {
        $this->movement = new Movement([
            'type' => 0,
            'amount' => 0
        ]);
        if(count($this->accounts)) {
            $this->movement->account_id = $this->accounts->first()->id;
        }
    }

    public function submit()
    {
        $this->validate($this->operationRules);
        $this->operation->category_id = $this->category;
        $this->operation->user_id = Auth::user()->id;
        $this->operation->save();
        $this->commitMovements();
        $this->operation->movements()
                        ->saveMany($this->castMovementsToModels());
        return redirect()->route('account.index');
    }

    protected function castMovementsToModels(): array
    {
        return array_map(
            function (array $movementAttributes) {
                $move = new Movement($movementAttributes);
                $move->account_id = $movementAttributes['account_id'];
                return $move;
            },
            $this->movements
        );
    }

    protected function commitMovements()
    {
        foreach ($this->movements as $movement) {
            if($movement['type'] == 1) {
                Account::whereId($movement['account_id'])
                       ->increment('balance', $movement['amount']);
                continue;
            }
            Account::whereId($movement['account_id'])
                       ->decrement('balance', $movement['amount']);
        }
    }

    public function render()
    {
        return view('livewire.operation.create');
    }
}