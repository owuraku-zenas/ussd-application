<?php

namespace App\Http\Ussd\States\AirtineData;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;

class SelectServicePage extends State
{
    protected function beforeRendering(): void
    {
        //
        $this->menu->text('Airtime and Data Services')
        ->lineBreak(3)
        ->paginateListing([
           "Airtime",
           "Data"]
            , 1, 3, '. ')
        ->lineBreak(2)
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //

        $service = $this->record->input;
        $service_name = "";
        $network_name = $this->record->get("recipient_network_name");

        if($service == "1") {
            $service = "airtime";
            $service_name = $network_name . " Airtime";
        } elseif($service == "2") {
            $service = "bundle";
            $service_name = $network_name . " Internet Bundle";
        }
        $this->record->set("service",$service);
        $this->record->set("service_name",$service_name);

        $this->decision->equal(1, EnterAccountNumberPage::class)
            ->equal(2, EnterAccountNumberPage::class)
        ->equal('#', SelectNetworkPage::class)
        ->equal('0', WelcomePage::class)
        ->any(Error_page::class);
    }
}
