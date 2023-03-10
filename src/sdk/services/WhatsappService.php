<?php

namespace Sdk\Services;

use GuzzleHttp\Client;
use Sdk\Services\ServiceBase;

interface WhatsappServiceProps
{
  function sendText(array $args): array;
  function sendFile64(array $args, string $fileMimeType): array;
}

class WhatsappService extends ServiceBase implements WhatsappServiceProps
{
  private string $baseEndpoint = 'whatsapp';

  public function __construct(Client $httpClient)
  {
    parent::__construct($httpClient);
  }

  public function sendText(array $args): array
  {
    try {
      $phoneNumber = $args['phoneNumber'];
      $message = $args['message'];

      $data =  [
        "number" => $phoneNumber,
        "text" => $message
      ];

      $response = $this->httpClient->post("$this->baseEndpoint/sendText", [
        'json' => $data
      ]);

      return get_object_vars(json_decode($response->getBody()));
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function sendFile64(array $args, string $fileMimeType): array
  {
    try {
      $phoneNumber = $args['phoneNumber'];
      $filePath = $args['path'];
      $caption = $args['caption'];

      /* Converting the file to base64. */
      $fileEncoded64 = base64_encode(file_get_contents($filePath));

      $path = "data:$fileMimeType;base64,$fileEncoded64";

      $data =  [
        "number" => $phoneNumber,
        "path" => $path,
        "caption" => $caption
      ];

      $response = $this->httpClient->post("$this->baseEndpoint/sendFile64", [
        'json' => $data
      ]);

      return get_object_vars(json_decode($response->getBody()));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
