<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'telephone', 'image'];

    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
