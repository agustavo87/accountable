<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserDetail extends Component
{
    public bool $authenticated = false;

    public ?User $user = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check()) {
            $this->authenticated = true;
            $this->user = Auth::user();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-detail');
    }
}
