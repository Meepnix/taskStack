@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Admin Group</h2></div>
                <div class="panel-body">
                    <div class="panel-body">

                        <h3>Create Group</h3>

                        <form method="POST" action="{{ route('admin.group.store') }}">
                        @csrf
                        
                            <div class="form-group">
                                <label for="name1">Name</label>
                                <input type="text" class="form-control" id="name1" name="name" value="{{ old('name') }}"><br>
                            </div>

                            <button type="submit">Save</button>

                        </form>
                        <a href="{{ route('admin.group.show') }}" class="btn btn-default">Back</a>

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


