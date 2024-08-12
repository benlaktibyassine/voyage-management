<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Voyage extends Model
{
    use HasFactory;
    protected $fillable = [ 'codeqr', 'scanS_date','scanE_date', 'camion_id', 'camion_id '];
    protected $primaryKey = 'mat';
    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }
}
