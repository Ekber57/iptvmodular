<?php
namespace Modules\Iptv\App\Services;

use Modules\Iptv\Models\Bouquet;
use Modules\Iptv\DTOS\BouquetDTO;


class BouquetService {
    public function addBouquet(BouquetDTO $nntvBouquetDTO) {
        Bouquet::create([
            "bouquet_id" => $nntvBouquetDTO->id,
            "name" => $nntvBouquetDTO->name,
            "movies" => $nntvBouquetDTO->movies,
            "radios" => $nntvBouquetDTO->radios,
            "channels" => $nntvBouquetDTO->channels,
            "series" => $nntvBouquetDTO->series,
            "order" => $nntvBouquetDTO->order,
        ]);
    }
}



?>