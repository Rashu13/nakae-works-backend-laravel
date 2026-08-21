<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdminModel::updateOrCreate(
            ['email' => 'ashgmail@gmail.com'],
            [
                'name' => 'Admin',
                'password' => '123456',
            ]
        );

        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(StateCitySeeder::class);
    }
}
