<?php

namespace App\Http\Ussd\States\TalkToUs;

use Sparors\Ussd\State;

class OtherContacts extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        //

        $this->menu->Text("Other Contacts")
        ->lineBreak(2)
        ->line("WhatsApp: 0200000000")
        ->line("Facebook: USSD APP")
        ->line("Twitter: @ussd-app")
        ->line("Instagram: @ussd-app")
        ->line("Email: contactcenter@ussd-app.com");
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
