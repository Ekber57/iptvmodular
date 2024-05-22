<?php
namespace Modules\Iptv\externalAPIs;

use Exception;
use Modules\Iptv\DTOS\LineDTO;


class LinesAPI extends BaseNntvAPI
{
    public function createLine(LineDTO $nntvLineDTO)
    {
        $parametres = [
            "username=" => $nntvLineDTO->username,
            "password=" => $nntvLineDTO->password,
            "member_id=" => $nntvLineDTO->ownerId,
            "package_id=" => $nntvLineDTO->packageId,
            "bouquets_selected=" => json_encode($nntvLineDTO->bouquets),
            "exp_date="=> $nntvLineDTO->expDate,
          
        ];
        $paramStrings = array_map(function ($key, $value) {
            return $key . urlencode($value);
        }, array_keys($parametres), $parametres);

        $queryString = implode("&", $paramStrings);
        $this->buildUrl();
      $parametres["bouquets_selected="];
     $this->baseUrl = $this->baseUrl."create_line&".$queryString;
        $data =  $this->getData($this->baseUrl."&allowed_outputs=".json_encode([1,2,3]));
     
        if($data["status"] == "STATUS_FAILURE") {
            throw new Exception("XUI SYSTEM FAIlED");
        }
        return $data;
    }

    public function getLines($id) {
        $url = $this->buildUrl()."get_lines";
        $data = $this->getData($url);
    }

    public function editLine(LineDTO $lineDTO) {

    }




}
