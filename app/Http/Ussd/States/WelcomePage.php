<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\States\AirtineData\SelectNetworkPage;
use App\Http\Ussd\States\Send_money\NetworkPage;
use App\Http\Ussd\States\TalkToUs\TalkToUs;
use Sparors\Ussd\State;

class WelcomePage extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Welcome To My Ussd App')
            ->lineBreak(2)
            ->line('Select an option')
            ->paginateListing([
                'SEND MONEY',
                'AIRTIME/DATA',
                'TALK TO US']
                , 1, 3, '. ');
        //
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal('1', NetworkPage::class)
            ->equal('2', SelectNetworkPage::class)
            ->equal('3', TalkToUs::class)
            ->any(Error_page::class);
    }
}
