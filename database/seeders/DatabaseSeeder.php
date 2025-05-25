<?php

namespace Database\Seeders;

use App\Enum\Super;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Enum\Permissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash; 
use Database\Seeders\OrderStatusSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('12345678'), 
        // ]);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@crm.com',
            'password' => Hash::make('12345678'), 
        ]);

        // Will create a Role named for Super Admin
        Role::create([
            'name' => Super::Admin,
        ]);
        // Assign the Role to User
        $user->assignRole(Super::Admin->value,);

        // Creating all permissions
        foreach (Permissions::cases() as $case) {
            Permission::create([
                'name' => $case->value,
            ]);
        }

        // ProductCategory::factory(5)->create(); 
        // Product::factory(50)->create(); 
        $this->call(OrderStatusSeeder::class); 
    }

    

    
}
