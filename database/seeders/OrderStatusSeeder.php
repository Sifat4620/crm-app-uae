<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Active',
            'Processing',
            'Pending',
            'Canceled',
            'Terminated',
            'Fraud',
        ];

        foreach ($statuses as $status) {
            DB::table('order_statuses')->insert([
                'status_name' => $status,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
