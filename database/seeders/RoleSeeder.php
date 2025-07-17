<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Cliente', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Gestor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mecanico', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
