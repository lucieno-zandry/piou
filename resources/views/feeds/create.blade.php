@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add a New Feed</h2>

        <form action="{{ route('feeds.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="url">Feed URL</label>
                <input type="url" id="url" name="url" class="form-control" value="{{ old('url') }}" required>
                @error('url') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Feed</button>
        </form>
    </div>
@endsection
