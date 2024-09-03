<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'nombre_place', 'lieu', 'description', 'image', 'prix','heure', 'event_type_id'];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'event_reservation')
        ->withPivot('quantite', 'prix');
     }
     public function eventType()
{
    return $this->belongsTo(EventType::class);
}

public function isSoldOut()
{
    return $this->nombre_place <= 0;
}
}
