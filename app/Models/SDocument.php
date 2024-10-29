<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SDocument extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = ['supplier_id', 'document_type', 'file_path'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
