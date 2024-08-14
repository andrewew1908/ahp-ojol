@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ranking Results</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Alternative</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rankedAlternatives as $index => $result)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $result['alternative'] }}</td>
                <td>{{ $result['score'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
