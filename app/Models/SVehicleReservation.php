<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SVehicleReservation extends Model
{ use HasFactory;

    protected $table = 'vehicle_reservations';
    protected $fillable = ['supplier_id', 'vehicle_name', 'purpose', 'reservation_date'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
