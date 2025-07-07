<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Simulation\AvailableBankAccount;
use App\Models\Simulation\AvailableCard;
use Exception;

class BankService
{

    /**
     * Verifica si la cuenta bancaria existe y está activa.
     */
    public function verifyBankAccount($accountNumber): AvailableBankAccount
    {
        $query = AvailableBankAccount::where('account_number', $accountNumber)
        ->where('status', 'active');

        $bankAccount = $query->first();

        if (!$bankAccount) {
            throw new Exception('Cuenta bancaria no encontrada o inactiva.');
        }

        return $bankAccount;

    }

    /**
     * Verifica si la tarjeta existe y está activa, validando número, cvv y fecha de expiración.
     */
    public function verifyCard($cardNumber, $cvv, $expirationData): AvailableCard
    {
        $card = AvailableCard::where('number', $cardNumber)
            ->where('cvv', $cvv)
            ->where('expiration_date', $expirationData)
            ->where('status', 'active')
            ->first();

        if (!$card) {
            throw new Exception('La tarjeta no existe o está inhabilitada.');
        }
        return $card;
    }

    
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
