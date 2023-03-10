<?php

require_once './src/config/config.php';

use Bots\BotMessageText;

$sessionName = SESSION_NAME;
$phoneNumber = PHONE_NUMBER;
$message = 'Testando o robô de mensagem!';

it('should to be able send a message for a contact', function () {
    global $sessionName, $phoneNumber, $message;

    $botMessageText = new BotMessageText($sessionName, $phoneNumber);

    ['result' => $result, 'type' => $type] = $botMessageText->send([
        'message' => $message,
    ]);

    expect($result)->toBe(200);
    expect($type)->toBe('chat');
});

?>
