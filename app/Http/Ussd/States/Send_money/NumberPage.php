<?php

namespace App\Http\Ussd\States\Send_money;

use App\Http\Ussd\States\WelcomePage;
use Sparors\Ussd\State;

class NumberPage extends State
{
    protected function beforeRendering(): void
    {
        //
        $network = $this->record->input;
        $network_name = "";
        if($network == "1") {
            $network = "AIR";
            $network_name = "AirtelTigo";
        } elseif($network == "2") {
            $network = "MTN";
            $network_name = "MTN";
        } elseif($network == "3") {
            $network = "VOD";
            $network_name = "Vodafone";
        }

        $this->record->set("recipient_network",$network);
        $this->record->set("recipient_network_name",$network_name);

        $this->menu->text('Money Transfer to ' . $network_name)
        ->lineBreak(2)
        ->line('Enter Recipient Number')
        ->lineBreak(2)
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal('#', NetworkPage::class)
            ->equal('0', WelcomePage::class)
            ->phoneNumber(NumberValidationPage::class)
            ->any(Error_page::class);
    }
}
