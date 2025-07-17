<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cliente = Role::create(['name' => 'Cliente']);
        $gestor = Role::create(['name' => 'Gestor']);
        $mecanico = Role::create(['name' => 'Mecanico']);

        $assign = Permission::create(['name' => 'assign_mechanic']);
        $view = Permission::create(['name' => 'view_appointments']);

        $gestor->permissions()->attach([$assign->id, $view->id]);
        $mecanico->permissions()->attach([$view->id]);
    }
}
