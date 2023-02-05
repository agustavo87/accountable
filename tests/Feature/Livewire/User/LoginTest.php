<?php

namespace Tests\Feature\Livewire\User;

use App\Http\Livewire\User\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Login::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'raul@mycompany.com',
            'password' => Hash::make('passowrd')
        ]);

        Livewire::test(Login::class)
            ->set('email', 'raul@mycompany.com')
            ->set('password', 'passowrd')
            ->call('submit');
            
        $this->assertEquals($user->id, Auth::id());
    }
}
