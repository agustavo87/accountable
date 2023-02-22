<?php

namespace App\Http\Livewire\Operation;

use App\Models\{
    Account,
    Movement,
    Operation,
};
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public bool $dirty = false;

    public EloquentCollection $accounts;

    public $movementId = null;
    
    public EloquentCollection $categories;

    public $category;

    public Operation $operation;

    public Movement $movement;

    public array $movements = [];

    protected $operationRules = [
        'category' => ['required', 'exists:operation_categories,id'],
        'operation.name' => ['required', 'max:100', 'min:3'],
        'operation.notes' => ['sometimes', 'max:5000'],
    ];

    protected $movementRules = [
        'movement.account_id' => ['required', 'exists:accounts,id'],
        'movement.type' => ['required', 'boolean'],
        'movement.note' => ['sometimes', 'max:200'],
        'movement.amount' => ['required', 'numeric', 'min:0']
    ];
 
    protected $validationAttributes = [
        'movement.account_id' => 'account'
    ];

    protected $listeners = ['newCategory'];


    protected function getRules()
    {
        return $this->operationRules + $this->movementRules;
    }

    public function mount()
    {
        $user = Auth::user();
        $this->accounts = $user->accounts ?? new EloquentCollection() ;
        $this->hidrateCategories();
        $this->operation = new Operation();
        $this->newMovement();
    }

    protected function hidrateCategories()
    {
        $this->categories = Auth::user()->operationCategories ?? new EloquentCollection();
    }

    public function commitMovement()
    {
        $this->validate($this->movementRules);
        $this->movements[$this->movementId ?? $this->getId()] = $this->movement->load('account')->toArray();
        $this->newMovement();
    }

    public function remove($id)
    {
        unset($this->movements[$id]);
    }

    public function edit($id)
    {
        $movement = $this->movements[$id];
        unset($this->movements[$id]);
        $this->movementId = $id;
        $this->movement = new Movement($movement);
        $this->movement->account_id = $movement['account_id'];
    }

    protected function getId()
    {
        $keys = array_keys($this->movements);
        $max = count($keys) ? max($keys) : 0;
        return ++$max;
    }

    protected function newMovement()
    {
        $this->movement = Movement::factory()->empty()->make();
        $this->movementId = $this->movement->id;
    }

    public function submit()
    {
        $this->validate($this->operationRules);
        if(!count($this->movements)) {
            $this->addError('movements', 'At least a transaction for operation is required.');
            return;
        }
        $this->operation->category_id = $this->category;
        $this->operation->user_id = Auth::user()->id;
        $this->operation->save();
        $this->commitMovements();
        $this->operation->movements()
                        ->saveMany($this->castMovementsToModels());
        return redirect()->route('home');
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
        $this->dirty = false;
        return view('livewire.operation.create')
            ->layout('components.layouts.with-sidebar', [
                'user' => Auth::user(),
                'searchBar' => false
            ]);
    }

    public function newCategory($id)
    {
        $this->hidrateCategories();
        $this->category = $id;
    }
}