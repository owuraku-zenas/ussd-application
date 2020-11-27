<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Error_page extends State
{
    protected $action = self::PROMPT;
    protected function beforeRendering(): void
    {
        //
        $this->menu->text('An Error Occured during the transaction process!!!');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
