<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avenants extends Model
{
    protected $table = 'avenants';
    protected $fillable = [
        'decisionapprenti_id',
        'type',
        'date',
    ];
    use HasFactory;
}
