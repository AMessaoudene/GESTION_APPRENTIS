<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash; // Add this line

class utilisateurs extends Model
{
    protected $table = 'utilisateurs';
    protected $fillable = [
        'nom',
        'structure',
        'role',
        'numerofixe',
        'email',
        'password',
        'acces',
    ];
    use HasFactory;
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
