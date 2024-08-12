<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraison extends Model
{
    use HasFactory;
    protected $table ='bon_livraisons';
    protected $fillable = ['scaned', 'voyage_id', 'cmd_id','nbr_scanS','nbr_scanE'];
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }
    public function details()
    {
        return $this->hasMany(Detail_bl::class,'id_bl');
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class,'cmd_id');
    }
}
