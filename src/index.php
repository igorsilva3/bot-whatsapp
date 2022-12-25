<?php
require_once '../vendor/autoload.php';
require_once './config/config.php';

use Bots\BotMessageText;
use Bots\BotMessageFile64;

$phoneNumber = '5516991188107';
$message = 'Recebaaa!!!';

// $result = json_encode([
//     'status' => $action['result'],
//     'type' => $action['type'],
//     'session' => $action['session'],
//     'from' => str_replace('@c.us', '', $action['data']['from']),
//     'to' => str_replace('@c.us', '', $action['data']['to']),
//     'content' => $action['content'],
//     'timestamp' => $action['data']['timestamp'],
// ]);

/* Sending a message to the phone number. */

/* Sending a message to the phone number. */
// $botMessageText = new BotMessageText(SESSION_NAME, $phoneNumber);
// $botMessageText->send(['message' => $message]);

$botMessageFile64 = new BotMessageFile64(SESSION_NAME, $phoneNumber);
$botMessageFile64->send([
    'fileName' => 'Testando',
    'path' => realpath('../tmp/testando-meu-robô-de-enviar-documentos.pdf'),
    'caption' => 'Bot de documentos',
]);

// echo '<pre>sucess</pre>';

?>
