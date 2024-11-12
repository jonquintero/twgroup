<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Room\Models\Room;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Room::insert([
            ['name' => 'Sala A', 'description' => 'Sala de reuniones con capacidad para 10 personas'],
            ['name' => 'Sala B', 'description' => 'Sala pequeña para reuniones de hasta 5 personas'],
            ['name' => 'Sala C', 'description' => 'Sala grande con proyector y pizarra'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Room::whereIn('name', ['Sala A', 'Sala B', 'Sala C'])->delete();

    }
};
