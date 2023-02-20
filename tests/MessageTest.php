<?php

namespace Fitprime\L9SmsApi\Test;

use Fitprime\L9SmsApi\L9SmsApiMessage;

class MessageTest extends \PHPUnit\Framework\TestCase
{
    public function test_it_can_accepts_content_in_contructor()
    {
        $message = new L9SmsApiMessage('test sms');
        $this->assertEquals('test sms', $message->content);
    }

    public function test_it_can_accepts_content_by_setter()
    {
        $message = new L9SmsApiMessage();
        $message->content('test sms');
        $this->assertEquals('test sms', $message->content);
    }

    public function test_it_can_accepts_sender_by_setter()
    {
        $message = new L9SmsApiMessage();
        $message->sender('test sender');
        $this->assertEquals('test sender', $message->sender);
    }

    public function test_it_can_accepts_to_by_setter()
    {
        $message = new L9SmsApiMessage();
        $message->to('+123456789');
        $this->assertEquals('+123456789', $message->to);
    }
}
