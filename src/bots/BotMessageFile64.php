<?php

namespace Bots;

use Bots\Base;

enum FileMimeTypes: string
{
	case PNG = 'image/png';
	case JPG = 'image/jpeg';
	case GIF = 'image/gif';
	case PDF = 'application/pdf';
	case TXT = 'text/plain';
	case MP4 = 'video/mp4';
}

class BotMessageFile64 extends Base
{
	private FileMimeTypes $fileMimeType;

	public function __construct($whatsappService, int|string $phoneNumber, FileMimeTypes $fileMimeType)
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
			], $this->fileMimeType->value);

			return $response;
		} catch (\Throwable $error) {
			throw $error;
		}
	}
}
