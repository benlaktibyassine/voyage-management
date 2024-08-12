<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_bl extends Model
{
    use HasFactory;

    protected $table = 'details_bl';
    protected $fillable = ['id_bl', 'id_produit', 'qte'];

    // Define the relationship to the Produit model
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }

    // Define the relationship to the BonLivraison model
    public function bl()
    {
        return $this->belongsTo(BonLivraison::class, 'id_bl');
    }
}
