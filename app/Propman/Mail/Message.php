<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2015-07-02
 * Time: 06:37 PM
 */

namespace Propman\Mail;


class Message
{
    protected $mailer;

    public function __construct ($mailer)
    {
            $this->mailer = $mailer;
    }

    public function to ($address)
    {
        $this->mailer->addAddress($address);
    }

    public function subject ($subject)
    {
        $this->mailer->Subject = $subject;
    }

    public function body ($body)
    {
        $this->mailer->Body = $body;
    }
}