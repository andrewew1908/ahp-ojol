@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Your Motorbike Selection System</h1>
    <p>This is your decision support system for selecting the best motorbike using AHP.</p>

    <!-- Menampilkan data dinamis -->
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Criteria</h5>
                    <p class="card-text">{{ $criteriaCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Alternatives</h5>
                    <p class="card-text">{{ $alternativeCount }}</p>
                </div>
            </div>
        </div>

    <nav class="mt-4">
        <ul>
            <li><a href="{{ route('criteria.index') }}" class="btn btn-primary">kriteria</a></li>
            <li><a href="{{ route('alternatives.index') }}" class="btn btn-primary">Merek motor</a></li>
            <li><a href="{{ route('criteria_comparisons.index') }}" class="btn btn-primary">Perbandingan kriteria</a></li>
            <li><a href="{{ route('alternative-comparisons.index') }}" class="btn btn-primary">Perbandingan Antar Motor</a></li>
            <li><a href="{{ route('results.index') }}" class="btn btn-primary">Hasil</a></li>
        </ul>
    </nav>
</div>
@endsection
