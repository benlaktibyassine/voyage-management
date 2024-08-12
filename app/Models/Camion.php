<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;
    protected $fillable = ['modele', 'marque', 'matricule'];
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
