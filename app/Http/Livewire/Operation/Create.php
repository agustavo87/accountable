<?php

namespace App\Http\Livewire\Operation;

use App\Models\{
    Account,
    Movement,
    Operation,
};
use App\Support\Facades\Money;
use App\Values\CurrencyType;
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

    public $amount;

    public array $errors;

    public array $movements = [];

    public array $currencyParameters;

    protected $operationRules = [
        'category' => ['required', 'exists:operation_categories,id'],
        'operation.name' => ['required', 'max:100', 'min:3'],
        'operation.notes' => ['sometimes', 'max:3000'],
    ];

    protected $movementRules = [
        'amount' => ['required', 'numeric', 'min:0'],
        'movement.account_id' => ['required', 'exists:accounts,id'],
        'movement.type' => ['required', 'boolean'],
        'movement.note' => ['sometimes', 'max:200'],
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
        $this->setCurrencyParameters(config('accountable.currencies.default'));
        $this->operation = new Operation();
        $this->newMovement();
    }

    protected function setCurrencyParameters($charCode)
    {
        $this->currencyParameters = Money::currencies(CurrencyType::Fiat)->get($charCode)->toArray();
    }

    protected function hidrateCategories()
    {
        $this->categories = Auth::user()->operationCategories ?? new EloquentCollection();
    }

    protected function newMovement()
    {
        $this->movement = new Movement();
        $this->movementId = $this->movement->id;
    }

    public function getAccountProperty()
    {
        return Account::find($this->movement->account_id);
    }

    public function commitMovement()
    {
        $this->validate($this->movementRules);
        
        $this->movement->amount = Money::from(CurrencyType::from($this->account->balance_currency_type))
                                        ->ofCurrencyNumber($this->account->balance_currency_number, "$this->amount");

        $this->movements[$this->movementId ?? $this->getId()] = $this->movement->load('account')->toArray();
        $this->newMovement();
        $this->amount = null;
        $this->dispatchBrowserEvent('money-input-updated');
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
        $this->amount = $this->movement->decimal_amount;
        $this->updateCurrencyParameters();

        $this->dispatchBrowserEvent('money-input-updated');
    }

    protected function getId()
    {
        $keys = array_keys($this->movements);
        $max = count($keys) ? max($keys) : 0;
        return ++$max;
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
                    ->first()
                    ->incrementBalance($movement['decimal_amount'])
                    ->save();
                continue;
            }
            Account::whereId($movement['account_id'])
                ->first()
                ->decrementBalance($movement['decimal_amount'])
                ->save();
        }
    }

    public function updatedMovement($value, $attribute) {
        if($attribute == 'account_id') {
            $this->updateCurrencyParameters();
        }
    }

    public function updateCurrencyParameters()
    {
        $this->currencyParameters = Account::find($this->movement->account_id)->currency->toArray();
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