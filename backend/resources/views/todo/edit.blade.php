@extends('layouts.app')

@section('title', 'Edit')

@section ('content')

<h4 class="h4">Edit task</h4>

<form action="{{ route('update', $task->id) }}" class="row mb-2 gx-2">
    @csrf
    @method('PATCH')

    <div class="col-10">
        <input type="text" class="form-control mb-3" name="task" value = "{{ old('task', $task->task) }}" placeholder="Edit Task...">
    </div>
    <div class="col-2">
        <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-check">Update</i></button>
    </div>
    @error('task')
        <p class="text-danger small"> {{ $message }} </p>
    @enderror
</form>

@endsection