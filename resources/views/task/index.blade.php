{{-- inherit from app layout --}}
@extends('layouts/app')

@section('title')
    All Tasks
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger w-75 mx-auto font-weight-bold">
            Please fix the following errors:<br />
            @foreach ($errors->all() as $err)
                <span class='ml-3'>* {{$err}}</span><br />
            @endforeach
        </div>
    @endif

    <div class="card w-75 mx-auto mb-4">
        <div class="card-header bg-primary text-light">Add Task</div>
        <div class="card-body">
            <form action="/" method="post" class="form-inline mx-auto w-75">
                @csrf
                <div class="form-group w-75">
                <input type="text" name="body" class="form-control w-100 {{$errors->has('body') ? 'is-invalid' : ''}}" placeholder="Task Body" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mx-3">Save</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped table-horizontal mx-auto w-75 table-responsive text-white">
        <tbody>
            @foreach($tasks as $task)
                <tr class="p-3">
                    <td class="py-3 w-75 align-middle bg-primary ">{{$task->body}}</td>
                    <td class="bg-primary"></td>
                    <td class="py-3 bg-dark align-middle">
                        @unless ($task->completed)
                        {{-- show this only if task not completed --}}
                        <form action="{{$task->id}}" method="post" class="d-inline">
                            <!-- HTML does not has patch or delete method, so we use laravel special function -->
                            @method('PATCH')
                            <!-- add csrf token into our form -->
                            @csrf
                            <button type='submit' class="btn btn-success mr-2">Complete</button>
                        </form>
                        @endunless
                        
                        <form action="{{$task->id}}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection