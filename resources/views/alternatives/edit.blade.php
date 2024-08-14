@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Alternative</h1>

    <form action="{{ route('alternatives.update', $alternative->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $alternative->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $alternative->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
