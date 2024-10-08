@extends('layouts.app')

@section('title', 'Perbandingan Alternatif')

@section('content')
<div class="container">
    <h1>Perbandingan Alternatif</h1>

    <form action="{{ route('alternative-comparisons.store') }}" method="POST">
        @csrf
        <select name="criteria_id" class="form-control">
            @foreach ($criteria as $key => $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Alternatif 1</th>
                        <th>Perbandingan</th>
                        <th>Alternatif 2</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @php
                        $tmparr = [];
                    @endphp --}}
                    @foreach($alternatives as $alternative1)
                        @foreach($alternatives as $alternative2)
                            @if($alternative1->id != $alternative2->id)
                            {{-- @if($alternative1->id != $alternative2->id && !in_array($alternative2->id, $tmparr)) --}}
                                <tr>
                                    <td>{{ $alternative1->name }}</td>
                                    <td>
                                        <select name="comparisons[{{ $alternative1->id }}_{{ $alternative2->id }}][value]" class="form-control">
                                            <option value="1/9">-9 tidak ekstrim lebih Penting</option>
                                            <option value="1/8">-8  Penting</option>
                                            <option value="1/7">-7  Penting</option>
                                            <option value="1/6">-6  Penting</option>
                                            <option value="1/5">-5  Penting</option>
                                            <option value="1/4">-4  Penting</option>
                                            <option value="1/3">-3 tidak cukup penting</option>
                                            <option value="1/2">-2 diantara sama penting dan cukup penting</option>
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
                                    <td>{{ $alternative2->name }}</td>
                                </tr>
                            @endif
                        @endforeach
                        {{-- @php
                            // array_push($tmparr, $alternative1->id);
                        @endphp --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perbandingan</button>
    </form>
</div>
@endsection
