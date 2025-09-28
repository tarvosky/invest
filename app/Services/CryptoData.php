<?php

namespace App\Services;

class CryptoData
{
        public static function getCryptoData()
        {
            $cryptoData = [];
            try {
                $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
                $apiKey = '0262be01-11cb-49e4-b317-d5ea3656875f';

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Accepts' => 'application/json',
                    'X-CMC_PRO_API_KEY' => $apiKey,
                ])->get($url, [
                    'start' => '1',
                    'limit' => '100',
                    'convert' => 'USD',
                ]);

                if ($response->successful()) {
                    $symbolsToShow = ['BTC', 'ETH', 'BNB', 'ADA', 'SOL', 'XRP', 'DOGE'];
                    $allCoins = $response->json()['data'];
                    $cryptoData = array_filter($allCoins, function ($coin) use ($symbolsToShow) {
                        return in_array($coin['symbol'], $symbolsToShow);
                    });
                    return $cryptoData;
                }
            } catch (\Exception $e) {
                // Handle error silently or log it
                $cryptoData = [];
                return $cryptoData;
            }
        }
}
