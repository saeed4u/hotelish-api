<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-03-10
 * Time: 21:09
 */

namespace App\Utils;


use Illuminate\Support\Collection;

class PushNotification
{
    public $title;
    public $message;
    /**
     * @var Collection $tokens
     */
    public $tokens;
    public $payload;
    public $type;


    public function __toString()
    {
        return "Title: $this->title, Message: $this->message, Tokens: $this->tokens";
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload): void
    {
        $this->payload = $payload;
    }




}