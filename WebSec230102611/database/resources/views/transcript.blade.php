@extends('layouts.master')

@section('title', 'Transcript')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Student Transcript</h2>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Course</th>
                <th>Degree</th>
                <th>Credit Hours</th>
                <th>Weighted Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            @php
                $class = '';
                if ($course['degree'] >= 85) {
                    $class = 'table-success'; // Green for high scores
                } elseif ($course['degree'] >= 70) {
                    $class = 'table-warning'; // Yellow for medium scores
                } else {
                    $class = 'table-danger'; // Red for low scores
                }
            @endphp
            <tr class="{{ $class }}">
                <td>{{ $course['name'] }}</td>
                <td>{{ $course['degree'] }}</td>
                <td>{{ $course['credit'] }}</td>
                <td>{{ round(($course['degree'] * $course['credit']) / 100, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h4 class="mt-3">GPA: <span class="badge bg-primary">{{ $gpa }}</span></h4>
</div>
@endsection
