<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $title = 'suppliers';
    protected $guarded = [];
    public function documents() {
        return $this->hasMany(SDocument::class);
    }

    public function profiles() {
        return $this->hasMany(SProfile::class);
    }

    public function registrations() {
        return $this->hasMany(SRegistration::class);
    }

    public function vehicleReservations() {
        return $this->hasMany(SVehicleReservation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
