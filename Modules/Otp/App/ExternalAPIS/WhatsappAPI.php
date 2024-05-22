<?php 
namespace Modules\Otp\App\ExternalAPIS;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Modules\Otp\App\DTOS\OtpDTO;

class WhatsappAPI {
   
    public function sendMessage(OtpDTO $otpDTO)
    {
     
        // Initialize Guzzle client
        $message =  "OTP code for password reset ". $otpDTO->code;
        
        $client = new Client();

        // Define the URL
        $url = 'https://paylash.eu.org/api/session/sendmessage';

        // Define the payload
        $payload = [
            'form_params' => [
                'apikey' => 'ADBD75CAC20965C6DEEE81C0857E7A7D',
                'session' => '12179127813',
                'msg' => $message   ,
                'to'=> "994559884227",
                // 'to'=> "994".substr($otpDTO->number,1)
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
                Log::channel("otp")->info("Phone ".$otpDTO->number."  ".$responseBody);
                return false;
            }
        } catch (\Exception $e) {
            Log::channel("otp")->info($e->getMessage()."Phone ".$otpDTO->number);
      
            return false;
        }
    }


    // private function sendToDeveloper($message) {
    //     $otpDTO = new OtpDTO();
    //     $otpDTO->number = "994559884227";
    //     $this->sendMessage($otpDTO,$message);
    // }
}





?>