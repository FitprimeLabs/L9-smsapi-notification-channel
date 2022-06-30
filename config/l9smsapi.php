<?php

use NotificationChannels\L9SmsApi\L9SmsApiChannel;

return [
    'token' => env('SMSAPI_AUTH_TOKEN'),
    'service' => L9SmsApiChannel::SERVICE_COM,
    'default_sender' => env('SMSAPI_DEFAULT_SENDER', 'L9SmsApi'),
];
