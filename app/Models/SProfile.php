<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SProfile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'supplier_id',
        'vendor_name',
        'contact_person',
        'contact_email',
        'contact_phone',
        'business_address',
        'bio',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
