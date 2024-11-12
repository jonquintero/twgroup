<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);


        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $admin->assignRole($adminRole);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $admin = User::whereEmail('admin@example.com')->first();
        $admin?->delete();
    }
};
