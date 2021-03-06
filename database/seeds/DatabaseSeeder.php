<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(BranchSeeder::class);
    }
}
