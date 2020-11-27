<?php

namespace App\Http\Ussd\States\TalkToUs;

use Sparors\Ussd\State;

class SendMessage extends State
{
    protected function beforeRendering(): void
    {
        //
        $this->menu->text("Enter Message")
        ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->any(FeedbackPage::class);
    }
}
