<?php

use Illuminate\Database\Seeder;
use App\ApiModel\UserAccountType;
class AccounttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAccountType::create(['account_type' => 'email']);
        UserAccountType::create(['account_type' => 'facebook']);
        UserAccountType::create(['account_type' => 'google']);
    }
}
