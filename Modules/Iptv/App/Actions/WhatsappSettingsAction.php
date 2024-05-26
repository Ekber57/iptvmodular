<?php 
namespace Modules\Iptv\App\Actions;
use App\Models\User;
use Modules\Iptv\Models\WhatsappSettings;
use Modules\Iptv\App\Services\WhatsappSettingsService;

class  WhatsappSettingsAction {
    protected $whatsappSettingsService;
    public function __construct(WhatsappSettingsService $whatsappSettingsService) {
        $this->whatsappSettingsService = $whatsappSettingsService;
    }
    public function createSettings(User $user) {
    
        WhatsappSettings::insert([
            [
                'user_id' => $user->id,
                'name' => 'when_line_created_send_whatsapp_message',
                'content' => 'Referal yeni istifadeci yaratdiqda whatsapp bildirisi alin',
                'status' => false,
            ],
            [
                'user_id' => $user->id,
                'name' => 'when_payement_request_send',
                'content' => 'Istifadeci yeni balans artirma isteyi yaratdiqda whatsapp bildirisi alin',
                'status' => false,
            ],
        ]);
    }
    public function showSettings() {
        return view("iptv::whatsappsettings");
    }
}




?>