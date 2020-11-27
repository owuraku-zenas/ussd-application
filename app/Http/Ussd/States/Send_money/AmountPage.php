<?php

namespace App\Http\Ussd\States\Send_money;

use Sparors\Ussd\State;

class AmountPage extends State
{
    protected function beforeRendering(): void
    {
        //
        $network_name  = $this->record->get("recipient_network_name");

        $this->menu->text('Money Transfer to ' . $network_name)
        ->line('*Recipient*')
        ->lineBreak(2)
        ->line('Enter Amount')
        ->lineBreak(2)
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->amount(ReferencePage::class)
            ->equal('#', NumberValidationPage::class)
            ->equal('0', WelcomePage::class)
            ->any(Error_page::class);
    }
}
