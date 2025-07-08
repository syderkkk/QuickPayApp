<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ExchangeRateService
{
    public static function getExchangeRate($fromCurrency, $toCurrency)
    {
        try {
            $response = Http::timeout(10)->get("https://api.exchangerate-api.com/v4/latest/{$fromCurrency}");

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['rates'][$toCurrency])) {
                    return round($data['rates'][$toCurrency], 4);
                }
            }
            
        } catch (Exception $e) {
            Log::error('Error getting exchange rate: ' . $e->getMessage());
        }
        return null;
    }
}