@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Alternative</h1>

    <form action="{{ route('alternatives.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        {{-- <div class="form-group"> --}}
            {{-- <label for="description">Description</label> --}}
            {{-- <textarea name="description" class="form-control" id="description"></textarea> --}}
        {{-- </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
