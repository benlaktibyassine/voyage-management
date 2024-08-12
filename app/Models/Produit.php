<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prix','image'];
    public function detailsCommand()
    {
        return $this->hasMany(DetailsCommande::class);
    }

    public function detailsBL()
    {
        return $this->hasMany(Detail_bl::class);
    }

}
