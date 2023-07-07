<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SliderSeeder::class);

//        setSetting('mail_port','465',null);
//        setSetting('mail_host','mail.prbbd.com',null);
//        setSetting('mail_encryption','tls',null);
//        setSetting('mail_username','admin@prbbd.com',null);
//        setSetting('mail_password','701([0(&+ake',null);
//        setSetting('mail_from_address','admin@prbbd.com',null);
//        setSetting('mail_from_name','PRB BD',null);
    }
}
