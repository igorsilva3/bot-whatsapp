<?php

namespace Bots;

use ApiGratis\ApiBrasil;
use Bots\Base;

class BotMessageText extends Base
{
    public function send($args)
    {
        $this->action = Action::sendText->value;

        $message = $args['message'];

        try {
            $response = ApiBrasil::WhatsAppService($this->action, [
                'serverhost' => SERVER_HOST,
                'sessionkey' => SESSION_KEY,
                'session' => $this->sessionName,
                'number' => $this->phoneNumber,
                'text' => $message,
            ]);

            return json_decode(json_encode($response), true);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}

?>
