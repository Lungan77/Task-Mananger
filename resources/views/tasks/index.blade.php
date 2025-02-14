@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Your Tasks</h1>
    
    <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Task</a>

    <ul class="mt-6">
        @foreach ($tasks as $task)
            <li class="border-b border-gray-300 py-4">
                <div>
                    <strong class="text-lg">{{ $task->title }}</strong>
                </div>
                <div class="text-gray-600">{{ $task->description }}</div>
                
                @if ($task->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($task->image) }}" alt="Task Image" width="100" class="rounded shadow-sm">
                    </div>
                @endif

                <div class="mt-3 flex justify-between items-center">
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
