@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Create Slot</h2>

            <form method="POST" action="{{ route('admin.slot.store') }}">
            @csrf
                        
                <div class="form-group">
                    <label for="title1">Title</label>
                    <input type="text" class="form-control" id="title1" name="title" value="{{ old('title') }}"><br>
                </div>

              <!--  time_period -->

               <!-- 
                mon
                tue
                wed
                thu
                fri
                all
                -->

                {!! Form::label('groups', 'Groups:') !!}

                {!! Form::select('task_id', ['L' => 'Large', 'S' => 'Small']) !!}




                <button type="submit">Save</button>

            </form>

            <a href="{{ route('admin.task.show') }}" class="btn btn-default">Back</a>

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
                        
@endsection


