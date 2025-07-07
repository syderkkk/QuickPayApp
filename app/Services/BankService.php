<?php

namespace App\Services;

use App\Models\Card;
use Exception;

class BankService
{
    public function charge(Card $card, float $amount)
    {
        $availableCard = $card->availableCard;

        if (!$availableCard) {
            throw new Exception('La tarjeta asociada no existe en el mundo simulado.');
        }

        if ($availableCard->status !== 'active') {
            throw new Exception('La tarjeta está inhabilitada.');
        }

        $bankAccount = $availableCard->availableBankAccount;

        if (!$bankAccount) {
            throw new Exception('La cuenta bancaria asociada a la tarjeta no existe.');
        }

        if ($bankAccount->status !== 'active') {
            throw new Exception('La cuenta bancaria está inhabilitada.');
        }

        if ($bankAccount->balance < $amount) {
            throw new Exception('Fondos insuficientes en la cuenta bancaria.');
        }

        $bankAccount->balance -= $amount;
        $bankAccount->save();

        return true;
    }

    public function depositToBankAccount($availableBankAccount, float $amount)
    {
        if ($availableBankAccount->status !== 'active') {
            throw new Exception('La cuenta bancaria está inhabilitada.');
        }

        $availableBankAccount->balance += $amount;
        $availableBankAccount->save();

        return true;
    }

}
