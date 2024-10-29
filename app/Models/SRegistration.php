<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SRegistration extends Model
{
    use HasFactory;

    protected $table = 'registration';
    protected $fillable = ['supplier_id', 'company_name', 'company_address', 'company_email', 'service_offerings', 'key_contacts', 'supporting_documents_path'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
