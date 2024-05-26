<?php 
namespace Modules\Iptv\App\Services;
use Modules\Iptv\Models\WhatsappSettings;
class WhatsappSettingsService {
    public function getSettingsByUserId(int $userId) {
        return WhatsappSettings::where('user_id',$userId);
    } 
}

?>