<?php
namespace Modules\Iptv\externalAPIs;

class GroupsAPI extends BaseNntvAPI{
    public function getGroups() {
       $data = $this->getData("get_groups",0,1000000);
       return $data;
    }
}





?>
