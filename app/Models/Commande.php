<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'etat', 'description', 'devis'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function detailsCommandes()
    {
        return $this->hasMany(DetailsCommande::class,'commande_id');
    }
}
