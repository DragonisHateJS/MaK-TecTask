<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tarifs;
use App\Models\Services;

class TarifResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->getMethod() == "GET" and response()->json()->getStatusCode() != 404) {
            $service = Services::find($request->service);
            $current_tarif = Tarifs::find($service["tarif_id"]);
            $tarifs = Tarifs::rowsByTarif($current_tarif["tarif_group_id"]);
            $tarifs_data = [];
            foreach ($tarifs as $tarif) {
                $tarifs_data[] = [
                    "ID" => $tarif["ID"],
                    "title" => $tarif["title"],
                    "price" => $tarif["price"],
                    "pay_period" => $tarif["pay_period"],
                    "new_payday" => mktime(0, 0, 0, date('m') + $tarif["pay_period"], date('d'), date('Y')),
                    "speed" => $tarif["speed"]
                ];
            }
            return response()->json([
                "result" => "ok",
                "title" => $current_tarif["title"],
                "link" => $current_tarif["link"],
                "speed" => $current_tarif["speed"],
                "tarifs" => $tarifs_data
            ]);
        }
        elseif ($request->getMethod() == "PUT" and response()->json()->getStatusCode() != 404){
            Services::updateByTarif($request->user_id, $request->tarif_id);
            return response()->json(["result" => "ok"]);
        }
        else{
            return response()->json(["result" => "error"]);
        }
    }
}
