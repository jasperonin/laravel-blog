@extends('layouts.app')

@section('title','Index')

@section('content')

<div class="card">
    <div class="card-header text-center">Todo App</div>
        <div class="card-body">
            <form action="{{ route('store') }}" class="row mb-2 gx-2">
                @csrf
                <div class="col-10">
                    <input type="text" class="form-control mb-3" name="task" value = "{{ old('task') }}" placeholder="Enter a task">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus"></i>Add</button>
                  
                </div>
            </form>
            @if ($all_tasks->isNotEmpty())
                <ul class="list-group">
                    @foreach ($all_tasks as $task)
                        <li class="list-group-item d-flex align-items-center mb-4">
                            <div class="me-auto">{{ $task->task }}</div>
                            
                            <a href="{{ route('todo.edit',$task->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-fill"></i></a>

                         
                            <form action="{{ route('destroy',$task->id) }}" method="post" class="ms-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
</div>

@endsection