<?php

namespace Bots;

use ApiGratis\ApiBrasil;
use Bots\Base;

class BotMessageFile64 extends Base
{
    public function send($args)
    {
        $this->action = Action::sendFile64->value;

        $fileName = $args['fileName'];
        $filePath = $args['path'];
        $caption = $args['caption'];

        /* Converting the file into a string. */
        $fileInString = file_get_contents($filePath);

        $path = 'data:application/pdf;base64,' . base64_encode($fileInString);

        echo json_encode([
            'filename' => $fileName,
            'caption' => $caption,
            'path' => $path,
        ]);

        try {
            $response = ApiBrasil::WhatsAppService($this->action, [
                'serverhost' => SERVER_HOST,
                'sessionkey' => SESSION_KEY,
                'session' => $this->sessionName,
                'number' => $this->phoneNumber,
                'fileName' => $fileName,
                'path' => $path,
                'caption' => $caption,
            ]);

            return json_decode(json_encode($response), true);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
?>
