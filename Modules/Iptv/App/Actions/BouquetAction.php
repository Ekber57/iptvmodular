<?php
namespace Modules\Iptv\App\Actions;

use Modules\Iptv\DTOS\BouquetDTO;

use Modules\Iptv\externalAPIs\BouquetsAPI;
use Modules\Iptv\App\Services\BouquetService;


class BouquetAction {
    protected $bouquetAPI;
    protected $bouquetService;
    public function __construct( BouquetService $bouquetService, BouquetsAPI $bouquetAPI) 
    {
        $this->bouquetAPI = $bouquetAPI;
        $this->bouquetService = $bouquetService;
    }

    public  function getBouquets () {
      
    }
    private function convertToDTO ($data) {
        $bouquets = [];
        foreach ($data as $bouquet) {
           $nntvBouquetDTO = new BouquetDTO();
           $nntvBouquetDTO->id = $bouquet["id"];
           $nntvBouquetDTO->name = $bouquet["bouquet_name"];
           $nntvBouquetDTO->movies = $bouquet["bouquet_movies"];
           $nntvBouquetDTO->channels = $bouquet["bouquet_channels"];
           $nntvBouquetDTO->radios = $bouquet["bouquet_radios"];
           $nntvBouquetDTO->series = $bouquet["bouquet_series"];
           $nntvBouquetDTO->order = $bouquet["bouquet_order"];
           array_push($bouquets,$nntvBouquetDTO);
        }
        return $bouquets;
    }
    public function sync() {
        $bouquets =  $this->convertToDTO($this->bouquetAPI->getBouquets());
        foreach ($bouquets as $bouquet) {
            $this->bouquetService->addBouquet($bouquet);
        }
    }

}


?>