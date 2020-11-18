<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifs extends Model
{
	protected $table = "tarifs";
    protected $fillable=['ID', 'title', 'price', 'link', 'speed', 'pay_period', 'tarif_group_id'];
    use HasFactory;

    public function scopeRowsByTarif($query, $tarif_group)
    {
        return $query->where('tarif_group_id', $tarif_group)->get();
    }
}
