@extends('layouts.app')

@section('title', 'Daftar Alternatif')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Alternatif</h1>

    <a href="{{ route('alternatives.create') }}" class="btn btn-primary mb-3">Tambah Alternatif</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama Alternatif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatives as $alternative)
                <tr>
                    <td>{{ $alternative->id }}</td>
                    <td>{{ $alternative->name }}</td>
                    <td>
                        <a href="{{ route('alternatives.edit', $alternative->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('alternatives.destroy', $alternative->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
