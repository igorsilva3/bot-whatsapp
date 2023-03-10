<?php

namespace Bots;

use Sdk\Services\WhatsappService;

interface BaseProps
{
    function send(array $args);
}

class Base implements BaseProps
{
    protected WhatsappService $whatsappService;
    protected string $phoneNumber;

    public function __construct(WhatsappService $whatsappService, string|int $phoneNumber)
    {
        $this->whatsappService = $whatsappService;
        $this->phoneNumber = $phoneNumber;
    }

    public function send(array $args)
    {
    }
}
