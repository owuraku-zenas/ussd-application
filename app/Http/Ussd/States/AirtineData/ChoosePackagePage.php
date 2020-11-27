<?php

namespace App\Http\Ussd\States\AirtineData;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;

class ChoosePackagePage extends State
{
    protected function beforeRendering(): void
    {

        $service_name = $this->record->get("service_name");

        $this->menu->text($service_name)
        ->lineBreak(2)
        ->line('Packages Available for you')
        ->lineBreak(3)
        ->line('DISPLAY 5 BUNDLES PER PAGE');

    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->between(1, 5, ConfirmationPage::class);
        // ->equal('#', EnterAccountNumberPage::class)
        // ->equal('0', WelcomePage::class)
        // ->any(Error_page::class);
    }
}
