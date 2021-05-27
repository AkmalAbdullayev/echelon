<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\MtradeUnit;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 'name' => 'admin']);
        Company::create([ 'name' => 'Echelon' ]);
        MtradeUnit::create(['name' => 'шт']);

        User::create([
            'role_id' => 1,
            'company_id' => 1,
            'name' => 'admin',
            'email' => 'admin@echelon.uz',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
        ]);
    }
}
