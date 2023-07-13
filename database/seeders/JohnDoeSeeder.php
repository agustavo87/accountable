<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Movement;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JohnDoeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name'  => 'John Doe',
            'email' => 'doe.j@example.com'
        ]);

        $accounts = [
            'Banco Local' => [
                'balance'   => ['19000', 'ARS']
            ],
            'US Account'    => [
                'balance'   => ['850', 'USD']
            ],
            'Spain Account' => [
                'balance'   => ['525', 'EUR']
            ],
            'Outcome (ARS)'       => [
                'balance'   => ['0', 'ARS']
            ],
            'Income (USD)'  => [
                'balance'   => ['0', 'USD']
            ],
            'Pocket Wallet' => [
                'balance'   => ['8500', 'ARS']
            ]
        ];


        $accountModels = collect();
        foreach ($accounts as $name => $account) {
            $accountModels->push(Account::factory()
                ->for($user)
                ->withBalance(...$account['balance'])
                ->create([
                    'name'  => $name
                ]));
        }

        $categories = [
            ['name' => 'Food'], 
            ['name' => 'Transactions'], 
            ['name' => 'Conversions'], 
            ['name' => 'Earnings'], 
            ['name' => 'Expenses'],
            ['name' => 'Inversions'], 
            ['name' => 'Transport'], 
            ['name' => 'Education']
        ];

        $categories = $user->operationCategories()->createMany($categories);

        $operations = [
            'Compra de pan'     => [
                'category'  =>  'Food',
                'movements' =>  [
                    [
                        'account'   => 'Pocket Wallet',
                        'type'      => 0,
                        'amount'    => 60000 
                    ],
                    [
                        'account'   => 'Outcome (ARS)',
                        'type'      => 1,
                        'amount'    => 60000 
                    ]
                ]
            ],
            'Compra de Arroz'     => [
                'category'  =>  'Food',
                'movements' =>  [
                    [
                        'account'   => 'Pocket Wallet',
                        'type'      => 0,
                        'amount'    => 25000 
                    ],
                    [
                        'account'   => 'Outcome (ARS)',
                        'type'      => 1,
                        'amount'    => 25000 
                    ]
                ]
            ],
            'Conversión de Dolares'     => [
                'category'  =>  'Conversions',
                'movements' =>  [
                    [
                        'account'   => 'US Account',
                        'type'      => 0,
                        'amount'    => 5000 
                    ],
                    [
                        'account'   => 'Banco Local',
                        'type'      => 1,
                        'amount'    => 2500000 
                    ]
                ]
            ],
            'Retiro de Plata'     => [
                'category'  =>  'Transactions',
                'movements' =>  [
                    [
                        'account'   => 'Banco Local',
                        'type'      => 0,
                        'amount'    => 1000000 
                    ],
                    [
                        'account'   => 'Pocket Wallet',
                        'type'      => 1,
                        'amount'    => 1000000 
                    ]
                ]
            ],
            'Desarrollo para Prismier'     => [
                'category'  =>  'Earnings',
                'movements' =>  [
                    [
                        'account'   => 'US Account',
                        'type'      => 1,
                        'amount'    => 160000 
                    ],
                    [
                        'account'   => 'Income (USD)',
                        'type'      => 0,
                        'amount'    => 160000  
                    ]
                ]
            ],
        ];

        foreach ($operations as $name => $operation) {
            Operation::factory(1, ['name'=> $name])
                ->for($user)
                ->for($categories->where('name', $operation['category'])->first(), 'category')
                ->has(
                    Movement::factory(2)
                        ->state(new Sequence(
                            [
                                'account_id' => $accountModels->where('name', $operation['movements'][0]['account'])->first()->id,
                                'type'  => $operation['movements'][0]['type'],
                                'minor_amount'   => $operation['movements'][0]['amount'],
                                'currency_number' => $accountModels->where('name', $operation['movements'][0]['account'])->first()->balance_currency_number,
                                'currency_type' => $accountModels->where('name', $operation['movements'][0]['account'])->first()->balance_currency_type    
                            ],
                            [
                                'account_id' => $accountModels->where('name', $operation['movements'][1]['account'])->first()->id,
                                'type'  => $operation['movements'][1]['type'],
                                'minor_amount'   => $operation['movements'][1]['amount'],
                                'currency_number' => $accountModels->where('name', $operation['movements'][1]['account'])->first()->balance_currency_number,
                                'currency_type' => $accountModels->where('name', $operation['movements'][1]['account'])->first()->balance_currency_type   
                            ],
                        ))
                )
                ->create();
        }
        
    }
}
