<?php

use App\Models\User as User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

class CreateRolesAndUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rolesNames = [
            'admin',
            'user',
        ];

        foreach (User::$roles as $role => $name) {
            Role::create(['name' => $role]);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        //User::where('email', 'admin@example.com')->first()->assignRole('admin');
        User::whereEncrypted('email', 'admin@example.com')->first()->assignRole('admin');
        User::whereEncrypted('email', 'user@example.com')->first()->assignRole('user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo 'I ruoli devono essere cancellati manualmente'.PHP_EOL;
    }
}
