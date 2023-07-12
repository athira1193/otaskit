<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $depts = [
            ['dept_name' => 'Sales','created_at' => now(),'updated_at' => now()],
            ['dept_name' => 'Marketting','created_at' => now(),'updated_at' => now()],
            ['dept_name' => 'IT','created_at' => now(),'updated_at' => now()]
        ];

        foreach($depts as $dept){
            Department::create($dept);
        }
    }
}
