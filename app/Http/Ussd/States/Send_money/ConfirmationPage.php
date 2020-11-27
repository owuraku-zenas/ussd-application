<?php

namespace App\Http\Ussd\States\Send_money;

use App\Http\Ussd\States\PromptPage;
use Sparors\Ussd\State;

class ConfirmationPage extends State
{
    protected function beforeRendering(): void
    {
        $number  = $this->record->get("recipient_number");
        $amount  = $this->record->get("amount");

        $this->menu->text('Confirmation Page')
        ->lineBreak(2)
        ->line('SERVICE: MONEY TRANSFER')
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
        ->equal('#', ReferencePage::class)
        ->equal('0', WelcomePage::class)
        ->any(Error_page::class);
    }
}
