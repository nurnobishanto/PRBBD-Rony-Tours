<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create([
            'operator' => 1,
            'bank_name' => 'one bank',
            'account_name' => 'noman',
            'account_no' => rand(1000000000, 9999999999),
            'branch_name' => 'Dhaka',
            'swift_code' => '123',
            'routing_no' => '123',
            'charge' => '10',
        ]);

        Bank::create([
            'operator' => 2,
            'bank_name' => 'Bkash',
            'account_name' => 'noman',
            'account_no' => rand(1000000000, 9999999999),
            'charge' => '20',
            'operator_type' => 1,
        ]);
    }
}
