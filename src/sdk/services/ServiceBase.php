<?php

namespace Sdk\Services;

use GuzzleHttp\Client;

class ServiceBase
{
  protected Client $httpClient;

  public function __construct(Client $httpClient)
  {
    $this->httpClient = $httpClient;
  }
}
