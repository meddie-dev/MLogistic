<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthLog extends Model
{
    use HasFactory;

    protected $table = 'auth_logs';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
