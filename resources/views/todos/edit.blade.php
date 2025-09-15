@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Edit Task</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="row g-2">
            @csrf
            @method('PUT')

            <div class="col-md-9">
                <input type="text" name="title" class="form-control" value="{{ $todo->title }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-3 d-flex">
                <button class="btn btn-success me-2">Update</button>
                <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
