<?php
namespace Modules\Iptv\externalAPIs;

class BouquetsAPI extends BaseNntvAPI{
    public function getBouquets() {
        return $this->getData("get_bouquets",0,1000000);
    }
}





?>