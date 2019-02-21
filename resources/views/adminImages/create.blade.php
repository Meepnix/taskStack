@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Upload Image</h2>
            <form method="POST" action="{{ route('admin.image.store', [$location->id]) }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="image1">Upload image</label>
                    <input type="file" id="image1" name="image">
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


