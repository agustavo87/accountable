<?php

namespace App\Http\Livewire\Category;

use App\Models\OperationCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $name = '';

    public $open = false;

    protected $validationAttributes = [
        'name' => 'category name'
    ];

    protected function rules()
    {
        return  [
            'name' => [
                'required',
                'min:3', 
                'max:100',
                Rule::unique('operation_categories', 'name')
                    ->where('user_id', Auth::id())
            ]
        ];
    }

    public function render()
    {
        return view('livewire.category.create');
    }

    public function create()
    {
        $data = $this->validate();
        $category = new OperationCategory($data);
        Auth::user()
            ->operationCategories()
            ->save($category);
        $category->refresh();
        $this->emit('newCategory', $category->id);
        $this->reset();
    }

    public function cancel()
    {
        $this->reset();
    }
}