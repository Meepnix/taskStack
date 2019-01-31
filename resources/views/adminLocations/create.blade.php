@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Create Location</h2>
            <form method="POST" action="{{ route('admin.location.store') }}">
            @csrf
                        
                <div class="form-group">
                    <label for="name1">Name</label>
                    <input type="text" class="form-control" id="name1" name="name" value="{{ old('name') }}"><br>
                </div>

                <button type="submit">Save</button>

            </form>
            
            <a href="{{ route('admin.location.show') }}" class="btn btn-default">Back</a>

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


