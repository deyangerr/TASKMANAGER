@extends('layouts.app')

@section('title', 'Task Manager')

@section('content')
    <header>
        <h1>Task Manager</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ New Task</a>
    </header>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($tasks->isEmpty())
        <p class="empty">No tasks yet. Add your first task!</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr class="{{ $task->status === 'Completed' ? 'completed' : '' }}">
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower($task->status) }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : '—' }}</td>
                    <td class="actions">
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline-form">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-small">
                                Mark {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}
                            </button>
                        </form>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-small">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-form"
                              onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
