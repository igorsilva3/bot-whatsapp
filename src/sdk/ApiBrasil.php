<?php

namespace Sdk;

use GuzzleHttp\Client;
use Sdk\Services\WhatsappService;

class ApiBrasil
{
  public WhatsappService $whatsappService;

  protected $token = '';
  protected array $headers;

  private string $baseUrl = SERVER_HOST;
  private Client $httpClient;

  public function __construct(array $options)
  {
    $this->setToken([
      'email' => $options['email'],
      'password' => $options['password']
    ]);

    $this->headers = [
      'Content-Type' => 'application/json',
      'SecretKey' => $options['secretKey'],
      'PublicToken' => $options['publicToken'],
      'DeviceToken' => $options['deviceToken'],
      'Authorization' => "Bearer $this->token"
    ];

    $this->httpClient = new Client([
      'base_uri' => $this->baseUrl,
      'headers' => $this->headers,
    ]);

    $this->whatsappService = new WhatsappService($this->httpClient);
  }


  private function login(array $credentials): array
  {
    try {
      $httpClient = new Client([
        'base_uri' => $this->baseUrl,
        'headers' => [
          'Content-Type' => 'application/json',
        ]
      ]);

      $email = $credentials['email'];
      $password = $credentials['password'];

      $data =  [
        "email" => $email,
        "password" => $password
      ];

      $response = $httpClient->post('login', [
        'json' => $data
      ]);

      return get_object_vars(json_decode($response->getBody()));
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  private function setToken(array $auth)
  {
    $loginData = $this->login([
      'email' => $auth['email'],
      'password' => $auth['password']
    ]);

    $this->token = $loginData['authorization']->token;
  }
}
