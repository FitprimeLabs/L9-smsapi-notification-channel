<?php

namespace Procionegobbo\L9SmsApi;

class L9SmsApiMessage
{
    public string $sender;
    public string $to;

    public function __construct(public string $content = '')
    {
    }

    public function content(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function sender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function to(string $phoneNumber): self
    {
        $this->to = $phoneNumber;

        return $this;
    }
}
