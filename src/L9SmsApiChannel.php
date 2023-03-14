<?php

namespace Fitprime\L9SmsApi;

use Fitprime\L9SmsApi\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use Smsapi\Client\Curl\SmsapiHttpClient;
use Smsapi\Client\Feature\Sms\Bag\SendSmsBag;
use Smsapi\Client\Service\SmsapiComService;
use Smsapi\Client\Service\SmsapiPlService;

class L9SmsApiChannel
{
    const SERVICE_COM = 1;
    const SERVICE_PL = 2;
    private SmsapiHttpClient $client;
    private SmsapiComService|SmsapiPlService $service;

    public function __construct(private string $token, private int $service_type = self::SERVICE_COM)
    {
        //initialize client
        $this->client = new SmsapiHttpClient();
        match ($this->service_type) {
            self::SERVICE_COM => $this->service = $this->client->smsapiComService($this->token),
            self::SERVICE_PL => $this->service = $this->client->smsapiPlService($this->token),
            default => throw new \Exception('L9SmsApi missing token and service in config'),
        };
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     *
     * @throws \Fitprime\L9SmsApi\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification): void
    {

        $message = $notification->toL9Smsapi($notifiable);
        if (is_string($message)) {
            $message = new L9SmsApiMessage($message);
        }

        $to = $notifiable->routeNotificationFor('l9smsapi') ?? $message->to;

        $sms = SendSmsBag::withMessage($to, $message->content);
        try {
            $response = $this->service->smsFeature()->sendSms($sms);
        } catch (\Exception $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        }
    }
}
