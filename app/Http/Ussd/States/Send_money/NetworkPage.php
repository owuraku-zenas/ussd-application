<?php

namespace App\Http\Ussd\States\Send_money;

use App\Http\Ussd\States\Error_page;
use Sparors\Ussd\State;

class NetworkPage extends State
{
    protected function beforeRendering(): void
    {
        //
        $this->menu->text('Money Transfer to Wallet')
            ->lineBreak(2)
            ->line('Select Recipient Wallet')
            ->paginateListing([
                'AirtelTigo Money',
                'MTN Mobile Money',
                'Vodafone Cash']
                , 1, 3, '. ')
            ->lineBreak(2)
            ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal('1',NumberPage::class)
            ->equal('2', NumberPage::class)
            ->equal('3', NumberPage::class)
            ->equal('0', WelcomePage::class)
            ->any(Error_page::class);
    }
}
