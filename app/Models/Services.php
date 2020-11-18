<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarifs;

class Services extends Model
{
	protected $table = "services";
    protected $fillable=['ID','user_id','tarif_id','payday'];
    use HasFactory;

    public function scopeUpdateByTarif($query, $service_id, $tarif_id){
        $pay_period = Tarifs::find($tarif_id)["pay_period"];
        return $query->where('ID', $service_id)->update(['tarif_id' => $tarif_id, 'payday' => mktime(0, 0, 0, date('m') + $pay_period, date('d'), date('Y'))]);
    }
}
