<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsCommande extends Model
{
    use HasFactory;
    protected $fillable = ['quantite ', 'produit_id', 'commande_id'];
    protected $table ="details_commande";
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
    // public function commande(){
    //     return $this->belongsTo(Commande::class);
    // }
}
