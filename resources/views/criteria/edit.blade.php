@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Criteria</div>
    <div class="card-body">
        <form action="{{ route('criteria.update', $criteria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $criteria->name) }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('criteria.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
