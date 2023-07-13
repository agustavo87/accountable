<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Account;
use App\Support\Facades\Money;
use App\Repositories\Currency\Crypto;
use App\Values\{BrickMoneyWrapper, BrickMoneyWrapperMoney, Currency, CurrencyType, RoundingMode};
use App\Exceptions\{CurrencyNotFoundException,MoneyMismatchException, RoundingNecessaryException};
use Brick\Math\RoundingMode as BrickRoundingMode;
use Brick\Money\Context\{CashContext, CustomContext, AutoContext};
use Brick\Money\Exception\MoneyMismatchException as BrickMoneyMismatchException;
use Brick\Math\Exception\RoundingNecessaryException as BrickRoundingNecessaryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoneyTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function the_money_can_be_created_persisted_and_retrieved()
    {
        $user = User::factory()->create();

        $someMoney = Money::of('15.25', 'USD');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someMoney;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $this->assertTrue($accountB->balance->equals($someMoney));
    }

    /** @test */
    public function it_is_possible_to_make_basic_operations_and_is_inmutable()
    {
        $money = Money::of(50, 'USD');

        $this->assertEquals('USD 54.99', "{$money->plus('4.99')}");
        $this->assertEquals('USD 49.00', "{$money->minus(1)}");
        $this->assertEquals('USD 99.95', "{$money->multipliedBy('1.999')}");
        $this->assertEquals('USD 12.50', "{$money->dividedBy(4)}");
    }

    /** @test */
    public function it_is_possible_to_make_basic_operation_with_money_model()
    {
        $money = Money::of(50, 'USD');

        $this->assertEquals('USD 54.99', "{$money->plus(Money::of('4.99', 'USD'))}");
        $this->assertEquals('USD 49.00', "{$money->minus(Money::of(1, 'USD'))}");
    }

    /** @test */
    public function it_is_possible_operate_and_save_money_models()
    {
        $user = User::factory()->create();
        $someMoney = Money::of(50, 'USD');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someMoney;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $accountB->balance = $accountB->balance->dividedBy(4);

        $accountB->save();

        $accountC = Account::find($id);

        $this->assertEquals('USD 12.50', "{$accountC->balance}");

    }

    /** @test */
    public function exception_is_thrown_if_brick_monies_are_not_the_same()
    {
        $this->expectException(BrickMoneyMismatchException::class);
        $a = Money::brickOf(1, 'USD');
        $b = Money::brickOf(1, 'EUR');

        $a->plus($b); // MoneyMismatchException
    }

    /** @test */
    public function exception_is_thrown_if_monies_are_not_the_same()
    {
        $this->expectException(MoneyMismatchException::class);
        $a = Money::of(1, 'USD');
        $b = Money::of(1, 'EUR');

        $a->plus($b); // MoneyException
        $this->assertTrue(true);
    }

    /** @test */
    public function if_rounding_needed_in_brick_money_exception_is_thrown()
    {
        $this->expectException(BrickRoundingNecessaryException::class);
        $money = Money::brickOf(50, 'USD');

        $money->plus('0.999'); // RoundingNecessaryException
    }

    /** @test */
    public function if_rounding_needed_exception_is_thrown()
    {
        $this->expectException(RoundingNecessaryException::class);
        $money = Money::of(50, 'USD');

        $money->plus('0.999'); // MathException
    }

    /** @test */
    public function if_a_rounding_mode_is_passed_to_brick_money_no_exception_is_thrown_when_rounding_is_neccesary()
    {
        $money = Money::brickOf(50, 'USD');

        // $money->plus('0.999'); // RoundingNecessaryException
        $this->assertEquals('USD 50.99', "{$money->plus('0.999', BrickRoundingMode::DOWN)}");

        // $money->minus('0.999'); // RoundingNecessaryException
        $this->assertEquals('USD 49.01', "{$money->minus('0.999', BrickRoundingMode::UP)}");

        // $money->multipliedBy('1.2345'); // RoundingNecessaryException
        $this->assertEquals('USD 61.72', "{$money->multipliedBy('1.2345', BrickRoundingMode::DOWN)}");

        // $money->dividedBy(3); // RoundingNecessaryException
        $this->assertEquals('USD 16.67', "{$money->dividedBy(3, BrickRoundingMode::UP)}");
    }

    /** @test */
    public function if_a_rounding_mode_is_passed_no_exception_is_thrown_when_rounding_is_neccesary()
    {
        $money = Money::of(50, 'USD');

        // $money->plus('0.999'); // MathException
        $this->assertEquals('USD 50.99', "{$money->plus('0.999', RoundingMode::DOWN)}");

        // $money->minus('0.999'); // MathException
        $this->assertEquals('USD 49.01', "{$money->minus('0.999', RoundingMode::UP)}");

        // $money->multipliedBy('1.2345'); // MathException
        $this->assertEquals('USD 61.72', "{$money->multipliedBy('1.2345', RoundingMode::DOWN)}");

        // $money->dividedBy(3); // MathException
        $this->assertEquals('USD 16.67', "{$money->dividedBy(3, RoundingMode::UP)}");
    }

    /** @test */
    public function brick_money_cash_context_work()
    {
        $money = Money::brickOf(10, 'CHF', new CashContext(5)); // CHF 10.00
        
        $this->assertEquals('CHF 3.30', "{$money->dividedBy(3, BrickRoundingMode::DOWN)}"); 

        $this->assertEquals('CHF 3.35', "{$money->dividedBy(3, BrickRoundingMode::UP)}");
    }

    /** @test */
    public function brick_money_custom_scales_works()
    {
        $money = Money::brickOf(10, 'USD', new CustomContext(4));
        $this->assertEquals('USD 10.0000', "{$money}");
        $this->assertEquals('USD 1.4286', "{$money->dividedBy(7, BrickRoundingMode::UP)}");
    }

    /** @test */
    public function brick_money_auto_scale_works()
    {
        $money = Money::brickOf('1.10', 'USD', new AutoContext()); // USD 1.1
        $this->assertEquals('USD 1.1', "{$money}");
        $this->assertEquals('USD 2.75', "{$money->multipliedBy('2.5')}");
        $this->assertEquals('USD 0.1375', "{$money->dividedBy(8)}");
    }

    /** @test */
    public function btrick_money_works_with_rational_numbers()
    {
        $money = Money::brickOf('9.5', 'EUR');
        $this->assertEquals('EUR 9.50', "$money"); 
        $rMoney = $money->toRational(); 
        $this->assertEquals('EUR 950/100', "$rMoney"); 
        $rMoney = $rMoney->dividedBy(3); 
        $this->assertEquals('EUR 950/300', "$rMoney"); 
        $rMoney = $rMoney->plus('17.795');
        $this->assertEquals('EUR 6288500/300000', "$rMoney"); 
        $rMoney = $rMoney->multipliedBy('1.196');
        $this->assertEquals('EUR 7521046000/300000000', "$rMoney"); 
        $money = $rMoney->to($money->getContext(), BrickRoundingMode::DOWN);
        $this->assertEquals('EUR 25.07', "$money"); 
    }

    /** @test */
    public function split_allocation_works_with_brick_money()
    {
        $money = Money::brickOf(100, 'USD');
        $this->assertEquals(
            ['USD 33.34', 'USD 33.33', 'USD 33.33'],
            $money->split(3)
        );
    }

    /** @test */
    public function sub_elements_of_multiple_brick_monies_returned_are_wrapped()
    {
        $money = Money::brickOf(100, 'USD');
        $monies = $money->split(3);
        foreach ($monies as $subMoney) {
            $this->assertInstanceOf(BrickMoneyWrapper::class, $subMoney);
        }
    }

    /** @test */
    public function split_allocation_works_with_money()
    {
        $money = Money::of(100, 'USD');
        $this->assertEquals(
            ['USD 33.34', 'USD 33.33', 'USD 33.33'],
            $money->split(3)
        );
    }

    /** @test */
    public function sub_elements_of_multiple_monies_returned_are_wrapped()
    {
        $money = Money::of(100, 'USD');
        $monies = $money->split(3);
        foreach ($monies as $subMoney) {
            $this->assertInstanceOf(BrickMoneyWrapperMoney::class, $subMoney);
        }
    }

    /** @test */
    public function distribution_allocation_works_with_brick()
    {
        $profit = Money::brickOf('987.65', 'CHF');
        $this->assertEquals(
            ['CHF 474.08', 'CHF 404.93', 'CHF 108.64'],
            $profit->allocate(48, 41, 11)
        );
    }

    /** @test */
    public function distribution_allocation_works_with_money()
    {
        $profit = Money::of('987.65', 'CHF');
        $this->assertEquals(
            ['CHF 474.08', 'CHF 404.93', 'CHF 108.64'],
            $profit->allocate(48, 41, 11)
        );
    }

    /** @test */
    public function distribution_allocation_sub_items_are_money()
    {
        $profit = Money::of('987.65', 'CHF');
        $profits = $profit->allocate(48, 41, 11);
        foreach ($profits as $subProfit) {
            $this->assertInstanceOf(BrickMoneyWrapperMoney::class, $subProfit);
        }
    }

    /** @test */
    public function brick_allocation_works_well_with_roundings()
    {
        $profit = Money::brickOf('987.65', 'CHF', new CashContext(5));
        $this->assertEquals(
            ['CHF 474.10', 'CHF 404.95', 'CHF 108.60'],
            $profit->allocate(48, 41, 11)
        );
    }

    protected function seedCryptos()
    {
        Crypto::put('BTC', 22, 'Bitcoin', 8);
        Crypto::put('ETH', 23, 'Ethereum', 18);
    }

    /** @test */
    public function crypto_currency_is_correctly_created_by_decimals()
    {
        $this->seedCryptos();

        $Crypto = Money::from(CurrencyType::Crypto);

        $someBTC = $Crypto->of('0.052', 'BTC');

        $this->assertEquals("BTC 0.05200000", "{$someBTC}");
    }

    /**
     * @test
     * @todo Introduce DI on repos
     */
    public function big_crypto_with_satoshi_scale_can_be_created_and_saved_correctly()
    {
        $this->seedCryptos();

        $user = User::factory()->create();

        $Crypto = Money::from(CurrencyType::Crypto);

        /*
         * This will be a big bitcoin value of BTC 70,0000,000.00000001
         */
        $someBTC = $Crypto->ofMinor('70000000000000001', 'BTC');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someBTC;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $this->assertEquals("BTC 700000000.00000001", "{$someBTC}");
        $this->assertTrue($accountB->balance->equals($someBTC));
    }

    /**
     * @test
     * @todo Introduce DI on repos
     */
    public function big_crypto_with_wei_scale_can_be_created_and_saved_correctly()
    {
        $this->seedCryptos();

        $user = User::factory()->create();

        $Crypto = Money::from(CurrencyType::Crypto);

        /*
         * This will be a big Etherum value of ETH 70,0000,000.000000000000000001
         */
        $someETH = $Crypto->ofMinor('700000000000000000000000001', 'ETH');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someETH;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $this->assertEquals("ETH 700000000.000000000000000001", "{$someETH}");
        $this->assertTrue($accountB->balance->equals($someETH));
    }

       /** @test */
    public function it_is_possible_to_make_basic_operations_with_criptos_and_is_inmutable()
    {
        $this->seedCryptos();

        $money = Money::from(CurrencyType::Crypto)->of('0.05', 'BTC');

        $this->assertEquals('BTC 0.05499000', "{$money->plus('0.00499')}");
        $this->assertEquals('BTC 0.04900000', "{$money->minus('0.001')}");
        $this->assertEquals('BTC 0.09995000', "{$money->multipliedBy('1.999')}");
        $this->assertEquals('BTC 0.01250000', "{$money->dividedBy(4)}");
        $this->assertEquals('BTC 0.05000001', "{$money->plus('0.00000001')}");
    }

    /** @test */
    public function it_is_possible_to_make_basic_operation_with_money_model_in_cryptos()
    {
        $this->seedCryptos();
        $Crypto = Money::from(CurrencyType::Crypto);
        $money = $Crypto->of('0.05', 'BTC');

        $this->assertEquals('BTC 0.05499000', "{$money->plus($Crypto->of('0.00499', 'BTC'))}");
        $this->assertEquals('BTC 0.04900000', "{$money->minus($Crypto->of('0.001', 'BTC'))}");
    }

    /** @test */
    public function it_is_possible_operate_and_save_money_models_in_cryptos()
    {
        $this->seedCryptos();

        $user = User::factory()->create();
        $someMoney = Money::from(CurrencyType::Crypto)->of('0.05', 'BTC');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someMoney;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $accountB->balance = $accountB->balance->dividedBy(4);

        $accountB->save();

        $accountC = Account::find($id);

        $this->assertEquals('BTC 0.01250000', "{$accountC->balance}");
    }

    /** @test */
    public function exception_is_thrown_if_crypto_monies_are_not_the_same()
    {
        $this->seedCryptos();
        $this->expectException(MoneyMismatchException::class);
        $Crypto = Money::from(CurrencyType::Crypto);
        $a = $Crypto->of('0.01', 'BTC');
        $b = $Crypto->of('0.01', 'ETH');

        $a->plus($b); // MoneyException
    }

    /** @test */
    public function if_rounding_needed_with_cryptos_exception_is_thrown()
    {
        $this->seedCryptos();
        $this->expectException(RoundingNecessaryException::class);
        $money = Money::from(CurrencyType::Crypto)->of('0.05', 'BTC');

        $money->plus('0.0099999999'); // RoundingNecessaryException
    }

    /** @test */
    public function if_a_rounding_mode_is_passed_no_exception_is_thrown_when_rounding_is_neccesary_with_cryptos()
    {
        $this->seedCryptos();

        $money = Money::from(CurrencyType::Crypto)->of('0.0005', 'BTC');

        $this->assertEquals('BTC 0.00050999', "{$money->plus('0.000009999', RoundingMode::DOWN)}");

        $this->assertEquals('BTC 0.00049001', "{$money->minus('0.000009999', RoundingMode::UP)}");

        $this->assertEquals('BTC 0.00061728', "{$money->multipliedBy('1.234567', RoundingMode::DOWN)}");

        $this->assertEquals('BTC 0.00016667', "{$money->dividedBy(3, RoundingMode::UP)}");
    }

    /** @test */
    public function split_allocation_works_with_crypto_money()
    {
        $this->seedCryptos();
        $money = Money::from(CurrencyType::Crypto)->of('0.1', 'BTC');
        $this->assertEquals(
            ['BTC 0.03333334', 'BTC 0.03333333', 'BTC 0.03333333'],
            $money->split(3)
        );
    }

    /** @test */
    public function distribution_allocation_works_with_crypto_money()
    {
        $this->seedCryptos();
        $profit = Money::from(CurrencyType::Crypto)->of('0.0098765', 'BTC');
        $this->assertEquals(
            ['BTC 0.00474073', 'BTC 0.00404936', 'BTC 0.00108641'],
            $profit->allocate(48, 41, 11)
        );
    }

    protected function seedCustomMoneyFor(User $user)
    {
        $customCurrencies = Money::customCurrenciesOf($user);
        $customCurrencies->put('ARA', 'Argentinian Austral', 3);
        $customCurrencies->put('ARP', 'Argentinan Patacon', 4);
    }

    /** @test */
    public function custom_monies_can_be_created()
    {
        $user = User::factory()->create();
        $this->seedCustomMoneyFor($user);

        $custom = Money::from(CurrencyType::Custom, [$user]);

        $someARA = $custom->of('4', 'ARA');

        $this->assertEquals("ARA 4.000", "{$someARA}");
    }

    /** @test */
    public function the_monies_of_a_user_can_be_retrieved()
    {
        $user = User::factory()->create();

        $this->seedCustomMoneyFor($user);
        
        $userB = User::factory()->create();

        Money::customCurrenciesOf($userB)->put('ESP', 'Spanish Peseta', 4);

        $currencies = Money::customCurrenciesOf($user);

        $userCurrencies = $currencies->all();

        $this->assertNotNull($userCurrencies->first(fn (Currency $currency) => $currency->getCurrencyCode() == 'ARA'));
        $this->assertNotNull($userCurrencies->first(fn (Currency $currency) => $currency->getCurrencyCode() == 'ARP'));
        $this->assertNull($userCurrencies->first(fn (Currency $currency) => $currency->getCurrencyCode() == 'ESP'));
    }

    /** @test **/
    public function custom_money_can_be_created_persisted_and_retrieved()
    {
        $user = User::factory()->create();

        $this->seedCustomMoneyFor($user);
        
        $someMoney = Money::from(CurrencyType::Custom, [$user])->of('15.25', 'ARA');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someMoney;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $this->assertTrue($accountB->balance->equals($someMoney));
    }

    /** @test */
    public function it_is_possible_operate_and_save_custom_money_models()
    {
        $user = User::factory()->create();

        $this->seedCustomMoneyFor($user);
        
        $someMoney = Money::from(CurrencyType::Custom, [$user])->of('50', 'ARA');

        $account = new Account([
            'user_id' => $user->id,
            'name' => 'my account'
        ]);
        
        $account->balance = $someMoney;

        $account->save();

        $id = $account->id;

        $accountB = Account::find($id);

        $accountB->balance = $accountB->balance->dividedBy(4);

        $accountB->save();

        $accountC = Account::find($id);

        $this->assertEquals('ARA 12.500', "{$accountC->balance}");
    }

     /** @test */
     public function exception_is_thrown_if_custom_monies_are_not_the_same()
     {
        $this->expectException(MoneyMismatchException::class);

        $user = User::factory()->create();
        $this->seedCustomMoneyFor($user);
        $customMoney = Money::from(CurrencyType::Custom, [$user]);

        $a = $customMoney->of(1, 'ARA');
        $b = $customMoney->of(1, 'ARP');
 
        $a->plus($b); // MoneyMismatchException
        $this->assertTrue(true);
     }

     /** @test */
     public function custom_currencies_of_a_diferent_user_can_not_be_retrieved_by_other_user()
     {
        $this->expectException(CurrencyNotFoundException::class);
        $user = User::factory()->create();

        $this->seedCustomMoneyFor($user);
        
        $userB = User::factory()->create();
        Money::customCurrenciesOf($userB)->put('ESP', 'Spanish Peseta', 4);

        $userBCustomMoney = Money::from(CurrencyType::Custom, [$userB]);
        $someMoney = $userBCustomMoney->of('1', 'ARA');
     }

}
