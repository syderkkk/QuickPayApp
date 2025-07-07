<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Simulation\AvailableBankAccount;
use App\Models\Simulation\AvailableCard;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentGatewayService
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
    public function verifyCard($cardNumber, $cvv, $expiry_month, $expiry_year)
    {
        $card = AvailableCard::where('number', $cardNumber)
            ->where('cvv', $cvv)
            ->where('expiry_month', $expiry_month)
            ->where('expiry_year', $expiry_year)
            ->where('status', 'active')
            ->first();

        if (!$card) {
            throw new Exception('La tarjeta no existe o está inhabilitada.');
        }

        $token = 'sim_' . $card->id . '_' . bin2hex(random_bytes(8));
        return [
            'token' => $token,
            'brand' => $card->brand,
            'last_four' => $card->last_four,
        ];
    }


    public function charge(string $token, float $amount)
    {
        return DB::transaction(function () use ($token, $amount) {
            if (!str_starts_with($token, 'sim_')) {
                throw new Exception('Token de tarjeta inválido.');
            }

            $parts = explode('_', $token);
            if (count($parts) < 3) {
                throw new Exception('Token de tarjeta mal formado.');
            }

            $availableCardId = $parts[1];
            $availableCard = AvailableCard::find($availableCardId);

            if (!$availableCard) {
                throw new Exception('La tarjeta asociada no existe en la simulación.');
            }

            if ($availableCard->status !== 'active') {
                throw new Exception('La tarjeta está inhabilitada.');
            }

            $bankAccount = AvailableBankAccount::where('id', $availableCard->available_bank_account_id)
                ->where('status', 'active')
                ->first();

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
        });
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
