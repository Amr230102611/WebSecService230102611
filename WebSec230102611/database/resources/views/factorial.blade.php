@extends('layouts.master')

@section('title', 'Factorial')

@section('content')
<!-- the actual function using recursion like the T.A reccomended is a global helper -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Factorial of {{ $number }}</div>
        <div class="card-body">
            <h3 class="text-center"> {{ $number }}! = {{ factorial($number) }}</h3>
        </div>
    </div>
</div>
@endsection
