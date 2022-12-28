<p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://i.imgur.com/FxL5qM0.jpg" alt="Bot logo"></a>
</p>

<h3 align="center">igorsilva3/bot-whatsapp</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

<p align="center"> 🤖 Ele envia mensagens de texto e arquivos para um contato no seu whatsapp.
    <br> 
</p>

## 📝 Table of Contents

- [Usage](#usage)
- [Getting Started](#getting_started)
- [Built Using](#built_using)
- [Authors](#authors)

## 🎈 Usage <a name = "usage"></a>

To use the bot, use the classes:

BotMessageText and BotMessageFile64.

## Examples

```php

use Bots\BotMessageText;
use Bots\BotMessageFile64;
use Bots\FileMimeTypes;

// Instance of BotMessageText
$botMessageText = new BotMessageText('YOUR_SESSION_NAME', 'PHONE_NUMBER');

$botMessageText->send(['message' => 'YOUR_MESSAGE']);

// Instance of BotMessageFile64
$botMessageText = new BotMessageFile64('YOUR_SESSION_NAME', 'PHONE_NUMBER', FileMimeTypes::PDF);

$botMessageText->send([
  'fileName' => 'YOUR_FILE_NAME',
  'caption' => 'YOUR_CAPTION',
  'path' => 'YOUR_FILE_PATH',
]);
```

## 🏁 Getting Started <a name = "getting_started"></a>

Clone this repository:

```bash
git clone https://github.com/igorsilva3/bot-whatsapp
```

### Prerequisites

For execute the project, you need to have installed in your machine:

- PHP 8
- Composer

And you need to get your api token in: [Documentation](https://documenter.getpostman.com/view/24382542/2s8YeptYaN)

Edit your configurations in the file config/config.php:

```php
define('API_KEY', 'YOUR_API_KEY');
define('SESSION_KEY', 'YOUR_API_KEY');
define('SESSION_NAME', 'YOUR_SESSION_NAME');
define('PHONE_NUMBER', 'YOUR_CONTACT_TO_MESSAGE');
```

*Observation*: *API_KEY and SESSION_KEY are equals.*

Start a session in: [Start session](https://whatsapp-free01.wppserver.com/start)

### Installing

```bash
cd bot-whatsapp/
```

Installing dependencies of the project: 

```bash
composer install
```

### Running tests

To run the tests, type:

```bash
composer pest
```

For more informations about the tests, acess: [PEST](https://pestphp.com/docs/installation)

## ⛏️ Built Using <a name = "built_using"></a>

- [PHP 8](https://www.php.net/) - Programming Language
- [SDK PHP - APIGratis by APIBRASIL](https://github.com/jhowbhz/package-apigratis) - SDK PHP

## ✍️ Authors <a name = "authors"></a>

- [@igorsilva3](https://github.com/igorsilva3) - Idea & Initial work