<?php

namespace Bots;

use Bots\Base;

class BotMessageText extends Base
{
    public function send($args)
    {
        $message = $args['message'];

        try {
            $response = $this->whatsappService->sendText([
                'phoneNumber' => $this->phoneNumber,
                'message' => $message,
            ]);

            return $response;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
