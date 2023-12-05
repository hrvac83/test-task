<?php

namespace App\Http\Controllers;
use App\Models\Cryptocurrency;
use Illuminate\Http\Request;

class CryptocurrencyController extends Controller
{
    /**
     * Display a listing of the cryptocurrencies.
     */
    public function index()
    {
        $currencies = Cryptocurrency::all();

        return view('index', compact('currencies'));
    }

    /**
     * Display a listing of the top 10 cryptocurrencies by percent change.
     */
    public function top10List()
    {
        $currencies = Cryptocurrency::where('locked', false)
            ->orderBy('percent_change_15m', 'DESC')
            ->limit(10)
            ->get();

        return view('top10', compact('currencies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $currency = Cryptocurrency::findOrFail($id);

        return view('edit', compact('currency'));
    }

    /**
     * Update the currency price
     */
    public function updatePrice(Request $request, int $id)
    {
        $request->validate([
            'price' => 'required|numeric|gt:0'
        ]);

        $newPrice = $request->input('price');

        $currency = Cryptocurrency::findOrFail($id);
        $currency->price = $newPrice;
        $currency->locked = true;
        $currency->save();

        $message = $currency->symbol.' price updated to: ' . $currency->price;

        return redirect()
            ->route('index')
            ->with('success', $message);
    }
}
