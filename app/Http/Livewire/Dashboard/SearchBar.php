<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class SearchBar extends Component
{
    public $eventName = 'search';

    public $placeholder = 'Search..';

    public function render()
    {
        return view('livewire.dashboard.search-bar');
    }
}
