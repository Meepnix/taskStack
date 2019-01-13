@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Edit Task</h2></div>
                <div class="panel-body">
                    <div class="panel-body">

                        <form method="POST" action="{{ route('admin.task.update', [$task->id]) }}">
                        @csrf
                        @method('PATCH')
                        
                            <div class="form-group">
                                <label for="title1">Title</label>
                                 <input type="text" class="form-control" id="title1" name="title" value="{{ $task->title }}"><br>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="summernote">{{ $task->message }}</textarea>
                            </div>

                            <button type="submit">Save</button>

                        </form>
                        <a href="{{ route('admin.task.show') }}" class="btn btn-default">Back</a>

                    </div>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
                        
@endsection


