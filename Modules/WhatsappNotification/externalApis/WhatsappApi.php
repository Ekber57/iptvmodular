<?php 
namespace Modules\WhatsappNotification\externalApis;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Modules\WhatsappNotification\DTOS\WhatsappNotificationDTO;

class WhatsappAPI {
   
    public function sendMessage(WhatsappNotificationDTO $whatsappNotificationDTO)
    {
     
        // Initialize Guzzle client
        
        $client = new Client();

        // Define the URL
        $url = 'https://paylash.eu.org/api/session/sendmessage';

        // Define the payload
        $payload = [
            'form_params' => [
                'apikey' => 'ADBD75CAC20965C6DEEE81C0857E7A7D',
                'session' => '12179127813',
                'msg' => $whatsappNotificationDTO->message   ,
                'to'=> "994".substr($whatsappNotificationDTO->phone,1)
            ]
        ];

        try {
            // Send POST request
            $response = $client->post($url, $payload);

            // Get the response body
            $responseBody = json_decode($response->getBody(), true);
       
            if($responseBody->status) {
                return true;
            }
            else {
                return false;
            }
        } catch (\Exception $e) {
      
            return false;
        }
    }


}





?>