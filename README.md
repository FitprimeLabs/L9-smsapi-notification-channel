# Laravel 9 SMSAPI notification channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fitprime/l9-smsapi-notification-channel.svg?style=flat-square)](https://packagist.org/packages/fitprime/l9-smsapi-notification-channel)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/509148617/shield)](https://styleci.io/repos/509148617)
[![Total Downloads](https://img.shields.io/packagist/dt/fitprime/l9-smsapi-notification-channel.svg?style=flat-square)](https://packagist.org/packages/fitprime/l9-smsapi-notification-channel)

This package makes it easy to send notifications using [SMSAPI](https://www.smsapi.com/it) with Laravel 9.x

Easy to use notification channel for Laravel 9.x.

```php
$user->notify(new TestSms('This is a test message'));
```


## Contents

- [Installation](#installation)
	- [Setting up the L9SmsApi service](#setting-up-the-L9SmsApi-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

```
composer require fitprime/l9-smsapi-notification-channel
```

Create an account on [SMSAPI](https://www.smsapi.com/it) and get your API token.
Put your api key in the .env file in the root directory of your application.
    
```dotenv
SMSAPI_AUTH_TOKEN=<your_auth_token>
```

### Setting up the L9SmsApi service

If you needs to change the default setting for your app you must publish the configuration file. 

## Usage

### Send a message

```php
use Illuminate\Notifications\Notification;
use Fitprime\L9SmsApi\L9SmsApiChannel;
use Fitprime\L9SmsApi\L9SmsApiMessage;

class TestSms extends Notification
{
    public function via($notifiable)
    {
        return [L9SmsApiChannel::class];
    }

    public function toL9Smsapi($notifiable)
    {
        return (new L9SmsApiMessage())
            ->content( 'Text message content' )
            ->to($notifiable->phone_number);
    }
}
```

### Available Message methods

`content()` set the SMS message content

`to()` set the SMS message recipient

`sender()` set the SMS message sender

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please use the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Federico Maiorini](https://github.com/Procionegobbo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
