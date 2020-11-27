<?php

namespace App\Http\Ussd\States\AirtineData;

use App\Http\Ussd\States\PromptPage;
use App\Http\Ussd\States\Error_page;
use App\Http\Ussd\States\WelcomePage;
use Sparors\Ussd\State;

class ConfirmationPage extends State
{
    protected function beforeRendering(): void
    {
        //

        // Conﬁrm
        // Service:Surﬂine
        // Acc No:XXXXXXXX
        // Description:XXXXXXX
        // Network Fee:0.00
        // Total Debit:XXXX
        // 1.Ok
        // #.Back
        // 0.Main Menu

        $service_name = $this->record->get("service_name");
        $number = $this->record->get("recipient_phone_number");
        $amount = $this->record->get("amount");

        $this->menu->text('Confirmation Page')
        ->lineBreak(2)
        ->line('SERVICE: ' . $service_name)
        ->line('Name: XXXXXXXXXXXXXX')
        ->line('Number: ' . $number)
        ->line('Amount: ' . $amount)
        ->line('Network Fee: 0.00')
        ->line('Total Debit: ' . $amount)
        ->lineBreak(1)
        ->line('1. Ok')
        ->line('#. Back')
        ->line('0. Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        //
        $this->decision->equal("1", PromptPage::class)
        ->equal('#', ChoosePackagePage::class)
        ->equal('0', WelcomePage::class)
        ->any(Error_page::class);
    }
}
