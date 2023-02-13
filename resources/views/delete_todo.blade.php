@extends('layouts.app')
<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script></head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete {{$todo->name}}</div>

                <h5 class="card-header">
                    <a href="{{route('todo.index')}}" class="btn btn-sm btn-outline-primary">Go Back</a>
                </h5>

                <div class="card-body"> 
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif   
                    <form method="POST" action="{{ route('todo.destroy', $todo->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="deleteRecord" data-id="{{ $user->id }}" >Delete Record</button>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <h3>
                                    Are you sure you want to delete {{ $todo->name }}?
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    Yes
                                </button>
                                <a href="{{ route('todo.index') }}" class="btn btn-info">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
