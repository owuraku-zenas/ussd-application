<?php

namespace App\Http\Ussd\States\TalkToUs;

use App\Http\Ussd\States\WelcomePage;
use Sparors\Ussd\State;

class TalkToUs extends State
{
    protected function beforeRendering(): void
    {
        //
        $this->menu->text("Call Us - 0200000000")
        ->lineBreak(2)
        ->line('1. Send Message')
        ->line('2.Other Contacts')
        ->lineBreak(2)
        ->line('0. Main Menu');

    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal("1", SendMessage::class)
        ->equal("2", OtherContacts::class)
        ->equal("0", WelcomePage::class);
    }
}
