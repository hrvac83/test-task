@extends('templates/master')

@section('title', 'Edit price')

@section('content')

    <h2>Edit Cryptocurrency price</h2>

    <form method="post" action="{{ route('update', $currency->id) }}">
        @csrf
        @method('PATCH')

        <label for="price"><b>{{  $currency->symbol }}</b> price:</label>
        <input type="number" name="price" id="price" step="any"  value="{{ $currency->price }}" required>

        <button type="submit">Submit</button>

        @error('price')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </form>

    <a href="{{  route('index') }}">
        <button type="button">Cancel</button>
    </a>

@endsection
