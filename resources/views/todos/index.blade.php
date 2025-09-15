@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">My To-Do List</h5>
    </div>
    <div class="card-body">

        {{-- Add Task --}}
        <form action="{{ route('todos.store') }}" method="POST" class="row g-2 mb-4">
            @csrf
            <div class="col-md-9">
                <input type="text" name="title" class="form-control" placeholder="Enter a new task" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-3">
                <button class="btn btn-success w-100">Add Task</button>
            </div>
        </form>

        {{-- Task List --}}
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($todos as $todo)
                    <tr>
                        <td class="{{ $todo->is_completed ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $todo->title }}
                        </td>
                        <td>
                            <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm {{ $todo->is_completed ? 'btn-success' : 'btn-warning' }}">
                                    {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">No tasks yet. Add one above!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
