<?php

namespace App\Http\Ussd\States\TalkToUs;

use Sparors\Ussd\State;

class FeedbackPage extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        //
        $this->menu->text("Your feedback has been received.")
        ->lineBreak(2)
        ->line("Thank You.");
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
