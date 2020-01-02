{{-- inherit from app layout --}}
@extends('layouts/app')

@section('title')
    All Tasks
@endsection

@section('content')

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