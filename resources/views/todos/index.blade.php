@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-header">
                    All Todo List
                    <button type="button" class="btn btn-outline-secondary"  data-bs-target="#exampleModalToggle" data-bs-toggle="modal">New Task</button>
                </div>
                <div class="card-body">
                    {{-- <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    @forelse($todos as $todo)

                        <div class="card mb-3 ">
                            {{-- <div class="card-header">
                                <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm {{ $todo->is_completed ? 'btn-outline-success' : 'btn-outline-warning' }}">
                                        {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                                    </button>
                                </form>
                            </div> --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $todo->title }}</h5>
                                <p class="card-text">{{ date('F j, Y h:i A', strtotime($todo->created_at)); }}</p>
                                <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-secondary" onclick="return confirm('Delete this task?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                     @empty
                        <p colspan="3" class="text-center text-muted">No tasks yet. Add one above!</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Pending Todo List
                    <button type="button" class="btn btn-outline-secondary"  data-bs-target="#exampleModalToggle" data-bs-toggle="modal">New Task</button>
                </div>
                <div class="card-body">
                    @forelse($todos as $todo)
                        @if (!$todo->is_completed)
                            <div class="card mb-3 ">
                                <div class="card-header">
                                    <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $todo->is_completed ? 'btn-outline-success' : 'btn-outline-warning' }}">
                                            {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                                        </button>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $todo->title }}</h5>
                                    <p class="card-text">{{ date('F j, Y h:i A', strtotime($todo->created_at)); }}</p>
                                    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-secondary" onclick="return confirm('Delete this task?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p colspan="3" class="text-center text-muted">No tasks yet. Add one above!</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Completed Todo List
                    <button type="button" class="btn btn-outline-secondary"  data-bs-target="#exampleModalToggle" data-bs-toggle="modal">New Task</button>
                </div>
                <div class="card-body">
                    @forelse($todos as $todo)
                        @if ($todo->is_completed)
                            <div class="card mb-3 ">
                                <div class="card-header">
                                    <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $todo->is_completed ? 'btn-outline-success' : 'btn-outline-warning' }}">
                                            {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                                        </button>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $todo->title }}</h5>
                                    <p class="card-text">{{ date('F j, Y h:i A', strtotime($todo->created_at)); }}</p>
                                    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-secondary" onclick="return confirm('Delete this task?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p colspan="3" class="text-center text-muted">No tasks yet. Add one above!</p>
                    @endforelse
                </div>
            </div>
        </div>
  

        <!-- Modal -->
        <div class="modal fade" id="exampleModalToggle" tabindex="-1" aria-labelledby="exampleModalToggle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    {{-- Add Task --}}
                    <form action="{{ route('todos.store') }}" method="POST" class="row g-2 mb-4">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalToggle">New Task</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" placeholder="Enter a new task" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Add Task</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
