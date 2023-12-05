@extends('templates/master')

@section('title', 'Top 10 Cryptocurrencies by percent change 15m')

@section('content')

    <div>
        <a href="{{  route('index') }}">
            <button type="button">Cryptocurrencies</button>
        </a>
        <h2>Top 10</h2>
        <table>
            <thead>
            <tr>
                <th>Symbol</th>
                <th>Percent Change</th>
            </tr>
            </thead>
            <tbody>
            @foreach($currencies as $currency)
            <tr>
                <td>{{ $currency->symbol }}</td>
                <td>{{ $currency->percent_change_15m }}%</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
