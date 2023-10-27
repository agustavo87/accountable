<?php

namespace Tests\Feature\Livewire\Account;

use App\Http\Livewire\Account\Create as CreateAccount;
use App\Models\Account;
use App\Models\ISOCurrency;
use App\Models\User;
use App\Support\Facades\Money;
use App\Values\CurrencyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected function seedFiatCurrencies()
    {
        ISOCurrency::create([
            'code' => 'USD',
            'number'  => 840,
            'name'  => 'US Dollar',
            'minor_units' => 2,
            'symbol'    => '$',
        ]);

        ISOCurrency::create([
            'code' => 'ARS',
            'number'  => 032,
            'name'  => 'Argentine Peso',
            'minor_units' => 2,
            'symbol'    => '$',
        ]);
    }

    /** @test */
    public function the_component_can_render()
    {
        $this->seedFiatCurrencies();
        $component = Livewire::test(CreateAccount::class);

        $component->assertStatus(200);
    }

    /** @test */
    function can_create_account()
    {
        $this->seedFiatCurrencies();
        $this->actingAs(User::factory()->create());
    
        Livewire::test(CreateAccount::class)
            ->set('accountName', 'my city bank')
            ->set('accountBalance', 0)
            ->set('currencyCode', 'USD')
            ->call('create');
    
        $account = Account::whereName('my city bank')->first();
        $this->assertNotNull($account);
        $this->assertEquals('USD 0.00', "{$account->balance}");
        $this->assertEquals('USD', "{$account->currency->getCurrencyCode()}");
    }

    /** @test */
    function can_create_account_with_fiat_money()
    {
        $this->seedFiatCurrencies();
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateAccount::class)
            ->set('accountName', 'my city bank')
            ->set('accountBalance', '2.25')
            ->set('currencyCode', 'ARS' )
            ->call('create');
    
        $account = Account::whereName('my city bank')->first();
        $this->assertNotNull($account);
        $this->assertTrue($account->balance->equals(Money::of('2.25', 'ARS')));
    }
}
