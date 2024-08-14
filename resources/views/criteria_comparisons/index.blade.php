@extends('layouts.app')

@section('title', 'Perbandingan Kriteria')

@section('content')
<div class="container">
    <h1>Perbandingan Kriteria</h1>

    <form action="{{ route('criteria_comparisons.store') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Kriteria 1</th>
                        <th>Perbandingan</th>
                        <th>Kriteria 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($criteria as $criterion1)
                        @foreach($criteria as $criterion2)
                            @if($criterion1->id != $criterion2->id)
                                <tr>
                                    <td>{{ $criterion1->name }}</td>
                                    <td>
                                        <select name="comparisons[{{ $criterion1->id }}_{{ $criterion2->id }}][value]" class="form-control">
                                            <option value="1">1 Sama Penting</option>
                                            <option value="2">2 Diantara Sama Dan Cukup</option>
                                            <option value="3">3 Cukup Penting</option>
                                            <option value="4">4 Diantara Cukup Dan Penting</option>
                                            <option value="5">5 Penting</option>
                                            <option value="6">6 Diantara Penting Dan Sangat</option>
                                            <option value="7">7 Sangat Penting</option>
                                            <option value="8">8 Diantara Sangat Dan Ekstrim</option>
                                            <option value="9">9 Ekstrim Sangat Penting</option>
                                        </select>
                                    </td>
                                    <td>{{ $criterion2->name }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perbandingan</button>
    </form>
</div>
@endsection
