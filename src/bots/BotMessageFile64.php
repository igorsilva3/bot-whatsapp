<?php

namespace Bots;

use ApiGratis\ApiBrasil;
use Bots\Base;

enum FileMimeTypes: string {
    case PNG = 'image/png';
    case JPG = 'image/jpeg';
    case GIF = 'image/gif';
    case PDF = 'application/pdf';
    case TXT = 'text/plain';
    case MP4 = 'video/mp4';
} 

class BotMessageFile64 extends Base
{
    private string $fileMimeType;

    public function __construct(string $sessionName, int|string $phoneNumber, FileMimeTypes $fileMimeType) {
        parent::__construct($sessionName, $phoneNumber);

        $this->fileMimeType = $fileMimeType->value;
    }

    public function send($args)
    {
        $this->action = Action::sendFile64->value;

        $fileName = $args['fileName'];
        $filePath = $args['path'];
        $caption = $args['caption'];

        /* Converting the file into a string. */
        $fileInString = file_get_contents($filePath);

        $path = "data:$this->fileMimeType;base64," . base64_encode($fileInString);

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
