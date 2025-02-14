@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $task->title }}" required><br>
        <textarea name="description" required>{{ $task->description }}</textarea><br>
        <input type="file" name="image"><br>
        @if ($task->image)
            <img src="{{ Storage::url($task->image) }}" alt="Task Image" width="100"><br>
        @endif
        <button type="submit">Update Task</button>
    </form>
@endsection
