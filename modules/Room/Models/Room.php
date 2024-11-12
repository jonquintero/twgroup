<?php

namespace Modules\Room\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Reservation\Models\Reservation;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'name',
        'description'
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
