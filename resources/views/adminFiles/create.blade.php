@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Upload PDF</h2>
            <form method="POST" action="{{ route('admin.file.store', [$location->id]) }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="pdf1">Upload pdf</label>
                    <input type="file" id="pdf1" name="pdf">
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


