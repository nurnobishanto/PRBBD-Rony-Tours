<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Courier;
use App\Models\Disease;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Employee;
use App\Models\EmployeeCategory;
use App\Models\ExpenseCategory;
use App\Models\Group;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => "Super Admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

        ])->assignRole(['super_admin']);


    }
}
