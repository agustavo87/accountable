<?php

namespace Tests\Feature\Livewire\User;

use App\Http\Livewire\User\Create as UserCreate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(UserCreate::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function a_user_can_be_created()
    {
        Livewire::test(UserCreate::class)
                ->set('user.name', 'John Doe')
                ->set('user.email', 'doe.j@myorg.com')
                ->set('password', 'password')
                ->call('submit');

        $this->assertTrue(User::whereEmail('doe.j@myorg.com')->exists());
    }

    /** @test */
    public function a_created_user_can_be_authenticated()
    {
        Livewire::test(UserCreate::class)
                ->set('user.name', 'John Doe')
                ->set('user.email', 'doe.j@myorg.com')
                ->set('password', 'password')
                ->call('submit');

        $this->assertTrue(Auth::attempt([
            'email' => 'doe.j@myorg.com',
            'password' => 'password'
        ]));
    }
}
