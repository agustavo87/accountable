<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\AccountV2 as Account;
use App\Support\Facades\Money;
use App\Exceptions\{MathException, MoneyException};
use App\Values\{BrickMoneyWrapper, BrickMoneyWrapperMoney, RoundingMode};
use Brick\Math\RoundingMode as  BrickRoundingMode;
use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Money\Exception\MoneyMismatchException;
use Brick\Money\Context\{CashContext, CustomContext, AutoContext};
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
        $this->expectException(MoneyMismatchException::class);
        $a = Money::brickOf(1, 'USD');
        $b = Money::brickOf(1, 'EUR');

        $a->plus($b); // MoneyMismatchException
    }

    /** @test */
    public function exception_is_thrown_if_monies_are_not_the_same()
    {
        $this->expectException(MoneyException::class);
        $a = Money::of(1, 'USD');
        $b = Money::of(1, 'EUR');

        $a->plus($b); // MoneyException
        $this->assertTrue(true);
    }

    /** @test */
    public function if_rounding_needed_in_brick_money_exception_is_thrown()
    {
        $this->expectException(RoundingNecessaryException::class);
        $money = Money::brickOf(50, 'USD');

        $money->plus('0.999'); // RoundingNecessaryException
    }

    /** @test */
    public function if_rounding_needed_exception_is_thrown()
    {
        $this->expectException(MathException::class);
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
    public function money_cash_context_work()
    {
        $money = Money::brickOf(10, 'CHF', new CashContext(5)); // CHF 10.00
        
        $this->assertEquals('CHF 3.30', "{$money->dividedBy(3, BrickRoundingMode::DOWN)}"); 

        $this->assertEquals('CHF 3.35', "{$money->dividedBy(3, BrickRoundingMode::UP)}");
    }

    /** @test */
    public function custom_scales_works()
    {
        $money = Money::brickOf(10, 'USD', new CustomContext(4));
        $this->assertEquals('USD 10.0000', "{$money}");
        $this->assertEquals('USD 1.4286', "{$money->dividedBy(7, BrickRoundingMode::UP)}");
    }

    /** @test */
    public function auto_scale_works()
    {
        $money = Money::brickOf('1.10', 'USD', new AutoContext()); // USD 1.1
        $this->assertEquals('USD 1.1', "{$money}");
        $this->assertEquals('USD 2.75', "{$money->multipliedBy('2.5')}");
        $this->assertEquals('USD 0.1375', "{$money->dividedBy(8)}");
    }

    /** @test */
    public function works_with_rational_numbers()
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
    public function allocation_works_well_with_roundings()
    {
        $profit = Money::brickOf('987.65', 'CHF', new CashContext(5));
        $this->assertEquals(
            ['CHF 474.10', 'CHF 404.95', 'CHF 108.60'],
            $profit->allocate(48, 41, 11)
        );
    }

}
