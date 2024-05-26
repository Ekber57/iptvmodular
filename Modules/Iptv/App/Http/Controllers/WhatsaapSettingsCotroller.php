<?php 
namespace Modules\Iptv\App\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Iptv\App\Actions\WhatsappSettingsAction;
class WhatsaapSettingsCotroller extends Controller {
    public function showSettings(WhatsappSettingsAction $whatsappSettingsAction) {
        return $whatsappSettingsAction->showSettings();
    }
}





?>