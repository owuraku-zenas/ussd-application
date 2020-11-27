<?php

namespace App\Http\Ussd\States\AirtineData;

use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;
use Sparors\Ussd\State;

class ConfirmNumberPage extends State
{
    protected function beforeRendering(): void
    {
        //

        $service_name = $this->record->get("service_name");

        $this->menu->text($service_name)
        ->lineBreak(2)
        ->line('Confirm account Number')
        ->line($this->record->get("recipient_phone_number"))
        ->line('1. Ok')
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $service = $this->record->get("service");

        if($service == "bundle") {

            $this->decision->equal("1", ChoosePackagePage::class)
             ->equal('#', EnterAccountNumberPage::class)
             ->equal('0', WelcomePage::class)
             ->any(Error_page::class);

        } elseif($service == "airtime") {

             $this->decision->equal("1", AirtimeAmountPage::class)
            ->equal('#', EnterAccountNumberPage::class)
            ->equal('0', WelcomePage::class)
            ->any(Error_page::class);

        }
    }
}
