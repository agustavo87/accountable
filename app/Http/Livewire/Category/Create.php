<?php

namespace App\Http\Livewire\Category;

use App\Models\OperationCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required'
    ];

    public function render()
    {
        return view('livewire.category.create');
    }

    public function submit()
    {
        $category = new OperationCategory($this->validate());
        $category->user()->associate(Auth::user());
        $category->save();
        return redirect()->route('operation.create');
    }
}