<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Garante que os roles existem primeiro
        $this->call([
            RoleSeeder::class,
        ]);

        // Busca o ID do role 'Cliente'
        $clienteRoleId = Role::where('name', 'Cliente')->first()->id;

        // Cria o user com role_id
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $clienteRoleId,    
        ]);
    }
}
