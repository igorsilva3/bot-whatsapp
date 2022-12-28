<?php

require_once './src/config/config.php';

use Bots\BotMessageFile64;
use Bots\FileMimeTypes;

$sessionName = SESSION_NAME;
$phoneNumber = PHONE_NUMBER;
$fileName = 'Teste';
$caption = 'Testando o robô de arquivos!';

$pathPDF = realpath('./tmp/testando-meu-robô-de-enviar-documentos.pdf');
$pathMP4 = realpath('./tmp/giphy480p.mp4');
$pathGIF = realpath('./tmp/giphy480p.gif');
$pathPNG = realpath('./tmp/code.png');
$pathJPG = realpath('./tmp/fb-leverage-of-coding.jpg');

it('should to be able send a pdf document for a contact', function () {
    global $sessionName, $phoneNumber, $pathPDF, $fileName, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $sessionName,
        $phoneNumber,
        FileMimeTypes::PDF
    );

    ['result' => $result, 'type' => $type] = $botMessageFile64->send([
        'fileName' => $fileName,
        'caption' => $caption,
        'path' => $pathPDF,
    ]);

    expect($result)->toBe(200);
    expect($type)->toBe('file');
});

it('should to be able send a mp4 video for a contact', function () {
    global $sessionName, $phoneNumber, $pathMP4, $fileName, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $sessionName,
        $phoneNumber,
        FileMimeTypes::MP4
    );

    ['result' => $result, 'type' => $type] = $botMessageFile64->send([
        'fileName' => $fileName,
        'caption' => $caption,
        'path' => $pathMP4,
    ]);

    expect($result)->toBe(200);
    expect($type)->toBe('file');
});

it('should to be able send a gif image for a contact', function () {
    global $sessionName, $phoneNumber, $pathGIF, $fileName, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $sessionName,
        $phoneNumber,
        FileMimeTypes::GIF
    );

    ['result' => $result, 'type' => $type] = $botMessageFile64->send([
        'fileName' => $fileName,
        'caption' => $caption,
        'path' => $pathGIF,
    ]);

    expect($result)->toBe(200);
    expect($type)->toBe('file');
});

it('should to be able send a png image for a contact', function () {
    global $sessionName, $phoneNumber, $pathPNG, $fileName, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $sessionName,
        $phoneNumber,
        FileMimeTypes::PNG
    );

    ['result' => $result, 'type' => $type] = $botMessageFile64->send([
        'fileName' => $fileName,
        'caption' => $caption,
        'path' => $pathPNG,
    ]);

    expect($result)->toBe(200);
    expect($type)->toBe('file');
});

it('should to be able send a jpg image for a contact', function () {
    global $sessionName, $phoneNumber, $pathJPG, $fileName, $caption;

    $botMessageFile64 = new BotMessageFile64(
        $sessionName,
        $phoneNumber,
        FileMimeTypes::JPG
    );

    ['result' => $result, 'type' => $type] = $botMessageFile64->send([
        'fileName' => $fileName,
        'caption' => $caption,
        'path' => $pathJPG,
    ]);

    expect($result)->toBe(200);
    expect($type)->toBe('file');
});

?>
