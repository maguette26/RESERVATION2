<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['date_reservation','user_id', 'event_id', 'status', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'event_reservation')
        ->withPivot('quantite', 'prix');
     }
     public function eventType()
{
    return $this->belongsTo(EventType::class);
}


}
