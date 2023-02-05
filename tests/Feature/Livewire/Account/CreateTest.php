<?php

namespace Tests\Feature\Livewire\Account;

use App\Http\Livewire\Account\Create as CreateAccount;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CreateAccount::class);

        $component->assertStatus(200);
    }

    /** @test */
    function can_create_account()
    {
        $this->actingAs(User::factory()->create());
    
        Livewire::test(CreateAccount::class)
            ->set('account.name', 'my city bank')
            ->set('account.currency', 'USD')
            ->set('account.balance', 0)
            ->call('create');
    
        $this->assertTrue(Account::whereName('my city bank')->exists());
    }
}
