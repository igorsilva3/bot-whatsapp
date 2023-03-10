<?php

namespace Bots;

use Bots\Base;

class BotMessageFile64 extends Base
{
	private string $fileMimeType;

	public function __construct($whatsappService, int|string $phoneNumber, string $fileMimeType)
	{
		parent::__construct($whatsappService, $phoneNumber);

		$this->fileMimeType = $fileMimeType;
	}

	public function send($args)
	{
		try {
			$filePath = $args['path'];
			$caption = $args['caption'];

			$response = $this->whatsappService->sendFile64([
				'phoneNumber' => $this->phoneNumber,
				'path' => $filePath,
				'caption' => $caption
			], $this->fileMimeType);

			return $response;
		} catch (\Throwable $error) {
			throw $error;
		}
	}
}
