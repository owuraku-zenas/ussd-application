<?php

namespace App\Http\Ussd\States\AirtineData;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;

class EnterAccountNumberPage extends State
{
    protected function beforeRendering(): void
    {
        $service_name = $this->record->get("service_name");

        $this->menu->text($service_name)
        ->lineBreak(2)
        ->line('Enter Account Number')
        ->lineBreak(2)
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //

        $this->record->set("recipient_phone_number", $this->record->input);

        $this->decision->phoneNumber(ConfirmNumberPage::class)
        ->equal('#', SelectNetworkPage::class)
        ->equal('0', WelcomePage::class)
        ->any(Error_page::class);
    }
}
