<?php

namespace Tests\Feature\Livewire\Operation;

use App\Http\Livewire\Operation\Create as CreateOperation;
use App\Models\Account;
use App\Models\Movement;
use App\Models\Operation;
use App\Models\OperationCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $this->withoutExceptionHandling();
        $component = Livewire::test(CreateOperation::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function an_operation_can_be_registered_with_an_account_movement()
    {
        $user = User::factory()->create();

        $account = Account::factory()
                          ->for($user)
                          ->withBalance('100.25','USD')
                          ->create();

        $this->assertEquals('USD 100.25', "$account->balance");

        $category = OperationCategory::factory()
                                    ->for($user)
                                    ->create();
                        

        Livewire::actingAs($user)
                ->test(CreateOperation::class)
                ->set('category', $category->id)
                ->set('operation.name', 'Buy bread')
                ->set('operation.notes', 'Buyed 1kg of bread on Don Julio Market')
                ->set('movement.account_id', $account->id)
                ->set('movement.type', 0) // debit
                ->set('movement.note', 'Pay to Julio')
                ->set('amount', '25.5')
                ->call('commitMovement')
                ->call('submit');

        $operation = $user->operations()->where('name', 'Buy bread')->first();

        $this->assertNotNull($operation);
        $this->assertEquals('Buyed 1kg of bread on Don Julio Market', $operation->notes);
        $this->assertEquals($category->id, $operation->category->id);

        $movement = $operation->movements->first();
        $this->assertEquals($movement->type, 0);
        $this->assertEquals('Pay to Julio', $movement->note);
        $this->assertEquals('USD 25.50', "$movement->amount");
        
        $resultAccount = $movement->account;
        $this->assertEquals($account->id, $resultAccount->id);
        $this->assertEquals('USD 74.75', "$resultAccount->balance");
    }
}
