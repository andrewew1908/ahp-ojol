@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add New Criteria</div>
    <div class="card-body">
        <form action="{{ route('criteria.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('criteria.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
