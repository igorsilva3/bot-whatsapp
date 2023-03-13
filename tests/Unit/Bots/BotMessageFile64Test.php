<?php

require_once './config/config.php';

use Bots\BotMessageFile64;
use Sdk\ApiBrasil;
use Bots\Utils\FileMimeTypes;

$apiBrasil = new ApiBrasil([
    'email' => AUTH_EMAIL,
    'password' => AUTH_PASSWORD,
    'secretKey' => SECRET_KEY,
    'publicToken' => PUBLIC_TOKEN,
    'deviceToken' => DEVICE_TOKEN
]);

$phoneNumber = PHONE_NUMBER_TEST;
$caption = 'Testando o robô de arquivos!';

$pathPDF = realpath('./tmp/testando-meu-robô-de-enviar-anexos.pdf');
$pathPNG = realpath('./tmp/testando-meu-robô-de-enviar-anexos.png');
$pathJPG = realpath('./tmp/testando-meu-robô-de-enviar-anexos.jpg');

it('should to be able send a pdf document for a contact', function () {
    global $apiBrasil, $phoneNumber, $pathPDF, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $apiBrasil->whatsappService,
        $phoneNumber,
        FileMimeTypes::PDF
    );

    ['error' => $error, 'message' => $messageRes] = $botMessageFile64->send([
        'path' => $pathPDF,
        'caption' => $caption,
    ]);

    expect($error)->toBe(false);
    expect($messageRes)->toBe('Requisição processada com sucesso');
});

it('should to be able send a png image for a contact', function () {
    global $apiBrasil, $phoneNumber, $pathPNG, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $apiBrasil->whatsappService,
        $phoneNumber,
        FileMimeTypes::PNG
    );

    ['error' => $error, 'message' => $messageRes] = $botMessageFile64->send([
        'path' => $pathPNG,
        'caption' => $caption,
    ]);


    expect($error)->toBe(false);
    expect($messageRes)->toBe('Requisição processada com sucesso');
});

it('should to be able send a jpg image for a contact', function () {
    global $apiBrasil, $phoneNumber, $pathJPG, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $apiBrasil->whatsappService,
        $phoneNumber,
        FileMimeTypes::JPG
    );

    ['error' => $error, 'message' => $messageRes] = $botMessageFile64->send([
        'path' => $pathJPG,
        'caption' => $caption,
    ]);


    expect($error)->toBe(false);
    expect($messageRes)->toBe('Requisição processada com sucesso');
});
