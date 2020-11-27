<?php

namespace App\Http\Ussd\States\AirtineData;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;

class AirtimeAmountPage extends State
{
    protected function beforeRendering(): void
    {
        //
        $service_name = $this->record->get("service_name");
        $recipient_number  = $this->record->get("recipient_phone_number");

        $this->menu->text($service_name)
        ->lineBreak(2)
        ->line('Enter Amount')
        ->lineBreak(2)
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //

        $this->record->set("amount", $this->record->input);

        $this->decision->amount(ConfirmationPage::class)
        ->equal('#', EnterAccountNumberPage::class)
        ->equal('0', WelcomePage::class)
        ->any(Error_page::class);
    }
}
