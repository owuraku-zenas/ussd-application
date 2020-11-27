<?php

namespace App\Http\Ussd\States\Send_money;

use Sparors\Ussd\State;

class NumberValidationPage extends State
{
    protected function beforeRendering(): void
    {
        $number = $this->record->input;
        $this->record->set("recipient_number", $number);

        $network_name  = $this->record->get("recipient_network_name");

        $this->menu->text('Money Transfer to ' . $network_name)
        ->lineBreak(2)
        ->line('Recipient Name: XXXXXXXXXXXXXX')
        ->line('Recipient Number: ' . $number)
        ->lineBreak(2)
        ->line('1. Ok')
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal('#', NumberPage::class)
            ->equal('0', WelcomePage::class)
            ->equal('1', AmountPage::class)
            ->any(Error_page::class);
    }
}
