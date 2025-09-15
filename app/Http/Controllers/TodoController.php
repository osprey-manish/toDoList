<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
     public function index()
    {
         $todos = Todo::orderBy('created_at', 'desc')->get();

        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        Todo::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return redirect()->route('todos.index')->with('success', 'Task added successfully!');
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update(['title' => $request->title]);

        return redirect()->route('todos.index')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        Todo::findOrFail($id)->delete();
        return redirect()->route('todos.index')->with('success', 'Task deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        return redirect()->route('todos.index')->with('success', 'Task status updated!');
    }
}
