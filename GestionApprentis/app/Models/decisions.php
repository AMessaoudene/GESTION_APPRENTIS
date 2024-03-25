<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class decisions extends Model
{
    protected $table = 'decisions';
    protected $fillable = [
        'reference',
        
    ];
    use HasFactory;
}
