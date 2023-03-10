<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="https://imgur.com/ew6Bw8D.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
  <title>Bot Whatsapp</title>

  <style type="text/css">
    body {
      font-family: 'Roboto Mono',
        monospace;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="mt-5">
      <div class="h3 text-center d-flex justify-content-center align-items-center">
        <span class="mt-2">
          <p>Bot Whatsapp</p>
        </span>
        <span class="mb-4">
          <img src="https://imgur.com/ew6Bw8D.png" alt="Bot Logo" width="60px" height="60px"></img>
        </span>
        </span>
      </div>

      <form action="" enctype="multipart/form-data" method="post" class="container-fluid" style="width: 50%;">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="exampleFormControlInput1" placeholder="5516999009900" name="phoneNumber" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Message</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="message"></textarea>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">File</label>
          <input class="form-control" type="file" id="formFile" name="file" accept="image/png, image/jpeg, image/gif, application/pdf, text/plain, video/mp4">
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-outline-primary mb-3" style="width: 100%;">Send</button>
        </div>
      </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>

<?php

require_once '../vendor/autoload.php';
require_once './config/config.php';

use Bots\BotMessageText;
use Bots\BotMessageFile64;
use Bots\Utils\FileMimeTypes;
use Sdk\ApiBrasil;

$apiBrasil = new ApiBrasil([
  'email' => AUTH_EMAIL,
  'password' => AUTH_PASSWORD,
  'secretKey' => SECRET_KEY,
  'publicToken' => PUBLIC_TOKEN,
  'deviceToken' => DEVICE_TOKEN
]);

$data = [
  'phoneNumber' => filter_input(INPUT_POST, "phoneNumber", FILTER_VALIDATE_INT),
  'message' => filter_input(INPUT_POST, "message"),
  'file' => $_FILES['file'],
];

$types = [
  'image/png' => FileMimeTypes::PNG,
  'image/jpeg' => FileMimeTypes::JPG,
  'image/gif' => FileMimeTypes::GIF,
  'application/pdf' => FileMimeTypes::PDF,
  'text/plain' => FileMimeTypes::TXT,
  'video/mp4' => FileMimeTypes::MP4,
];

$messageSuccess = '
<div class="container-fluid d-flex justify-content-center align-items-center">
  <div class="alert alert-success alert-dismissible fade show" style="width: 50%;" role="alert">
    Mensagem enviada com sucesso!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
';

$messageError = '
<div class="container-fluid d-flex justify-content-center align-items-center">
  <div class="alert alert-danger alert-dismissible fade show" style="width: 50%;" role="alert">
    Ops! Ocorreu um erro!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>';

if (!empty($data['message'])) {
  /* Sending a message to the phone number. */
  try {
    $message = $data['message'];
    $phoneNumber = $data['phoneNumber'];

    $botMessageText = new BotMessageText($apiBrasil->whatsappService, $phoneNumber);
    $botMessageText->send(['message' => $message]);

    echo $messageSuccess;
  } catch (\Throwable $th) {
    echo $messageError;
  }
}

if (!empty($data['file'])) {
  /* Sending a file to the phone number. */
  try {
    $phoneNumber = $data['phoneNumber'];
    $file = $data['file'];

    $botMessageFile64 = new BotMessageFile64(
      $apiBrasil->whatsappService,
      $phoneNumber,
      $types[$file['type']]
    );

    $botMessageFile64->send([
      'path' => $file['tmp_name'],
      'caption' => 'Bot Whatsapp!',
    ]);

    echo $messageSuccess;
  } catch (\Throwable $th) {
    echo $messageError;
  }
}

?>