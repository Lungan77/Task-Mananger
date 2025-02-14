@extends('layouts.app')

@section('content')
    <h1>Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Task title" required><br>
        <textarea name="description" placeholder="Task description" required></textarea><br>
        <input type="file" name="image"><br>
        <button type="submit">Create Task</button>
    </form>
@endsection
