@extends('templates/master')

@section('title', 'Cryptocurrencies')

@section('content')

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div>
        <a href="{{  route('top10') }}">
            <button type="button">Top 10 currencies by percent change 15m</button>
        </a>
        <h2>Cryptocurrencies</h2>
        <table>
            <thead>
            <tr>
                <th>Symbol</th>
                <th>Price (USD)</th>
                <th>Percent Change 15m</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($currencies as $currency)
            <tr>
                <td>{{ $currency->symbol }}</td>
                <td>{{ $currency->price }}</td>
                <td>@if($currency->locked) N/A @else{{ $currency->percent_change_15m }}%@endif</td>
                <td>
                    <a href="{{  route('edit', $currency->id) }}">Edit price</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
