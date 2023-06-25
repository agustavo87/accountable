<?php

namespace Tests\Feature\Livewire\Account;

use App\Http\Livewire\Account\Create as CreateAccount;
use App\Models\Account;
use App\Models\User;
use App\Support\Facades\Money;
use App\Values\CurrencyType;
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

    /** @test */
    function can_create_account_with_fiat_money()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateAccount::class)
            ->set('account.name', 'my city bank')
            ->set('account.currency', 'ARS' )
            ->set('account.balance', '2.25')
            ->call('create');
    
        $account = Account::whereName('my city bank')->first();
        $this->assertNotNull($account);
        $this->assertTrue($account->balanceb->equals(Money::of('2.25', 'ARS')));
    }
}
