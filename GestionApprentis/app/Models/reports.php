<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    public $table = 'reports';
    protected $fillable = [
        'id',
        'user_id',
        'titre',
        'description',
    ];

    use HasFactory;
}
