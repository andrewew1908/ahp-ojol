@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="container">
    <h1>Daftar Kriteria</h1>
    <a href="{{ route('criteria.create') }}" class="btn btn-primary mb-3">Tambah Kriteria</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($criteria as $criterion)
                <tr>
                    <td>{{ $criterion->id }}</td>
                    <td>{{ $criterion->name }}</td>
                    <td>
                        <a href="{{ route('criteria.edit', $criterion->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('criteria.destroy', $criterion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
