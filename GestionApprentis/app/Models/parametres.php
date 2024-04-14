<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parametres extends Model
{
    protected $table = 'parametres';
    protected $fillable = [
        'id',
        'reference',
        //'direction',
        'decisionresponsable',
        'datedecisionresponsable',
        'nomresponsable',
        'prenomresponsable',
        'civiliteresponsable',
        'fonctionresponsable',
        'typedecisiondg',
        'datedecisiondg',
        'nomprenomdg',
        'decisionpremierresponsable',
        'datedecisionpremierresponsable',
        'nomprenompremierresponsable',
        'fonctionpremierresponsable',
        'civilitedrh',
        'civilitedfc',
        'status',
    ];
    use HasFactory;
}
