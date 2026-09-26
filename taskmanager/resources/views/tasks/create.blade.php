@extends('layouts.app')

@section('title', 'New Task')

@section('content')
    <header>
        <h1>New Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn">← Back</a>
    </header>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
        @csrf

        <label for="task_name">Task Name</label>
        <input type="text" id="task_name" name="task_name" required value="{{ old('task_name') }}">

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="Pending" @selected(old('status') === 'Pending')>Pending</option>
            <option value="Completed" @selected(old('status') === 'Completed')>Completed</option>
        </select>

        <label for="due_date">Due Date</label>
        <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}">

        <button type="submit" class="btn btn-primary">Save Task</button>
    </form>
@endsection
