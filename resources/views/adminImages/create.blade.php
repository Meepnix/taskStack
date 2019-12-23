@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Upload Image</h3>
            <hr>
            <form method="POST" action="{{ route('admin.image.store', [$location->id]) }}" 
            enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="image1">Upload image</label>
                    <input type="file" id="image1" name="image">
                </div>

                <hr>
                <div class="float-right">
                    <a href="{{ route('admin.location.show') }}"  class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">UPLOAD</button>
                        
                </div>

            </form>
        

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


