<?php

require_once './src/config/config.php';

use Bots\BotMessageText;
use Sdk\ApiBrasil;

$phoneNumber = PHONE_NUMBER_TEST;
$message = 'Testando o robô de mensagem!';

$apiBrasil = new ApiBrasil([
	'email' => AUTH_EMAIL,
	'password' => AUTH_PASSWORD,
	'secretKey' => SECRET_KEY,
	'publicToken' => PUBLIC_TOKEN,
	'deviceToken' => DEVICE_TOKEN
]);

it('should to be able send a message for a contact', function () {
	global $apiBrasil, $phoneNumber, $message;

	$botMessageText = new BotMessageText($apiBrasil->whatsappService, $phoneNumber);

	['result' => $result, 'type' => $type] = $botMessageText->send([
		'message' => $message,
	]);

	expect($result)->toBe(200);
	expect($type)->toBe('chat');
});
