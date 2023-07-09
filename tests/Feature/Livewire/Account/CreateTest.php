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
            ->set('accountName', 'my city bank')
            ->set('accountBalance', 0)
            ->set('currency', 'USD')
            ->call('create');
    
        $account = Account::whereName('my city bank')->first();
        $this->assertNotNull($account);
        $this->assertEquals('USD 0.00', "{$account->balance}");
        $this->assertEquals('USD', "{$account->currency->getCurrencyCode()}");
    }

    /** @test */
    function can_create_account_with_fiat_money()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateAccount::class)
            ->set('accountName', 'my city bank')
            ->set('accountBalance', '2.25')
            ->set('currency', 'ARS' )
            ->call('create');
    
        $account = Account::whereName('my city bank')->first();
        $this->assertNotNull($account);
        $this->assertTrue($account->balance->equals(Money::of('2.25', 'ARS')));
    }
}
