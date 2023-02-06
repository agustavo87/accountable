<?php

namespace App\View\Components\Layouts;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class TopNavBar extends Component
{
    public array $links = [];

    public ?User $user;

    public string $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->links = [
            'account.index' => 'Accounts',
            'operation.create' => 'Create Operation',
            'operation.index' => 'View Operations'
        ];

        $this->user = Auth::user();
        $this->route = Route::currentRouteName();
    }

    /**
     * Determine if the given route is the current one.
     */
    public function currentRoute(string $route): bool
    {
        return $route === $this->route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.layouts.top-nav-bar');
    }
}
