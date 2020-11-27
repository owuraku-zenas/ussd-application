<?php

namespace App\Http\Ussd\States\Send_money;

use Sparors\Ussd\State;

class ReferencePage extends State
{
    protected function beforeRendering(): void
    {
        //
        $network_name  = $this->record->get("recipient_network_name");

        $amount = $this->record->input;

        $this->record->set("amount", $amount);

        $this->menu->text('Money Transfer to '. $network_name)
        ->line('*Recipient*')
        ->lineBreak(2)
        ->line('Enter Reference')
        ->lineBreak(1)
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal('#', NetworkPage::class)
        ->equal('0', WelcomePage::class)
        ->any(ConfirmationPage::class);
    }
}
