<?php

namespace Bots;

use ApiGratis\ApiBrasil;

interface BaseProps
{
    function send(array $args);
    function startSession();
}

enum Action: string {
    case start = 'start';
    case qrcode = 'qrcode';
    case sendText = 'sendText';
    case sendFile = 'sendFile';
    case sendFile64 = 'sendFile64';
    case getAllGroups = 'getAllGroups';
}

class Base implements BaseProps
{
    protected string $action;
    protected string $sessionName;
    protected string $phoneNumber;

    public function __construct(string $sessionName, string|int $phoneNumber)
    {
        $this->sessionName = $sessionName;
        $this->phoneNumber = $phoneNumber;

        $this->startSession();
    }

    public function send(array $args) { }

    public function startSession() {
        try {
            $start = ApiBrasil::WhatsAppService(Action::start->value, [
                'serverhost' => SERVER_HOST,
                'apitoken' => API_KEY,
                'sessionkey' => SESSION_KEY,
                'session' => $this->sessionName
            ]);

            return json_decode(json_encode($start), true);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}

?>
