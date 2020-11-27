<?php

namespace App\Http\Ussd\States\AirtineData;

use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;
use Sparors\Ussd\State;

class SelectNetworkPage extends State
{
    protected function beforeRendering(): void
    {
        //

        $this->menu->text('Airtime and Data Services')
            ->lineBreak(2)
            ->line('Select Platform')
            ->paginateListing([
                'AirtelTigo',
                'Busy',
                'Glo',
                'MTN',
                'Surfline',
                'Vodafone']
                , 1, 6, '. ')
            ->lineBreak(2)
            ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $network = $this->record->input;
        // $network = $arguement;
        $network_name = "";
        $service = "";
        $service_name = "";
        if($network == "1") {
            $network = "AIR";
            $network_name = "AirtelTigo";
        } elseif($network == "2") {
            $network = "BUS";
            $network_name = "Busy";
            $service = "bundle";
            $service_name = $network_name ." Internet Bundle";
        } elseif($network == "3") {
            $network = "GLO";
            $network_name = "GLO";
        } elseif($network == "4") {
            $network = "MTN";
            $network_name = "MTN";
        } elseif($network == "5") {
            $network = "SUR";
            $network_name = "Surfline";
            $service = "bundle";
            $service_name = $network_name ." Internet Bundle";
        } elseif($network == "6") {
            $network = "VOD";
            $network_name = "Vodafone";
        }

        $this->record->set("recipient_network",$network);
        $this->record->set("recipient_network_name",$network_name);
        $this->record->set("service",$service);
        $this->record->set("service_name",$service_name);



        $this->decision
            ->equal(1, SelectServicePage::class)
            ->equal(3, SelectServicePage::class)
            ->equal(4, SelectServicePage::class)
            ->equal(6, SelectServicePage::class)
            ->equal(2, EnterAccountNumberPage::class)
            ->equal(5, EnterAccountNumberPage::class)
            ->equal('0', WelcomePage::class)
            ->any(Error_page::class);
    }
}
