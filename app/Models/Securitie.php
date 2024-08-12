<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Securitie extends Model
{
    use HasFactory;
    protected $table = 'securities';
    protected $fillable = [
        'nom',
        'prenom',
        'CIN',
        'telephone',
        'username',
        'password'

    ];
    protected $primaryKey = 'num_badge';
}
