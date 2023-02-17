<?php

namespace App\Http\Livewire;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

use Livewire\Component;

class TwiliVideoLivewire extends Component
{

    public string $token;

    public function mount()
    {
        $this->generate_token();
    }

    public function generate_token()
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $apiKeySid = env('TWILIO_API_KEY_SID');
        $apiKeySecret = env('TWILIO_API_KEY_SECRET');

        $identity = uniqid();

        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom('cool room');
        $token->addGrant($grant);
        return $this->token = $token->toJWT();

        // Serialize the token as a JWT
        // echo $token->toJWT();
    }

    public function render()
    {
        return view('livewire.twili-video-livewire');
    }
}
