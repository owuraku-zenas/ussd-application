<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class PromptPage extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        //
        $this->menu->text('Transaction is being processed!!');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
