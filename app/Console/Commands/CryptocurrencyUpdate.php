<?php

namespace App\Console\Commands;

use App\Models\Cryptocurrency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CryptocurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cryptocurrency-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cryptocurrencies from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.coinpaprika.com/v1/tickers');

        if ($response->failed()) {
            $this->error('Failed to fetch data from API.');
            return;
        }

        $lockedSymbols = Cryptocurrency::where('locked', true)
            ->pluck('symbol')
            ->toArray();

        $data = collect($response->json())
            ->reject(function ($item) use ($lockedSymbols) {
                return in_array($item['symbol'], $lockedSymbols);
            })
            ->map(function ($item) use ($lockedSymbols) {
                return [
                    'symbol' => $item['symbol'],
                    'percent_change_15m' => $item['quotes']['USD']['percent_change_15m'],
                    'price' => $item['quotes']['USD']['price']
                ];
            })
            ->toArray();

        Cryptocurrency::upsert(
            $data,
            ['symbol'],
            ['percent_change_15m', 'price']
        );

        $this->info('Data updated successfully.');
    }
}
