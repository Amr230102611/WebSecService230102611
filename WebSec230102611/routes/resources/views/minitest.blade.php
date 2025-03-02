@extends('layouts.master')

@section('title', 'MiniTest - Supermarket Bill')

@section('content')
<div class="container mt-3">
    <h2>Supermarket Bill</h2>
    <p><strong>Cashier:</strong> {{ $cashier }}</p>
    <p>{{ $id}}</p>
    
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bill as $entry)
            <tr>
                <td>{{ $entry['item'] }}</td>
                <td>{{ $entry['quantity'] }}</td>
                <td>{{ $entry['price'] }}</td>
                <td>{{ $entry['quantity'] * $entry['price'] }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total Amount:</strong></td>
                <td><strong>{{ $total }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection