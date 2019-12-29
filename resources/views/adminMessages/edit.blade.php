@extends('layouts.main')

@push('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

@endpush

@section('content')
<div id="app">
    <div class="container">

        @include('shared.flash')
        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            
                <h3>Edit Message</h3>
                <hr>

                <form method="POST" 
                action="{{ route('admin.message.update', [$message->id]) }}">
                @csrf
                @method('PATCH')  
                
                    <div class="form-group">
                        <h5>
                            <strong>Message</strong>
                        </h5>
                        <textarea 
                        name="message"
                        class="summernote" 
                        id="summernote">
                            {{ $message->message }}
                        </textarea>
                    </div>

                    

                    <hr>
                    <div class="float-right">
                        <a href="{{ route('admin.message.showGroups') }}"  class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                            
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
</div>

                 
@endsection


@push('endscripts')
<script>
$(document).ready(function() {
    $('#summernote').summernote({

        //Resolve can't scroll to the bottom issue
        followingToolbar: false,

        toolbar: [
            ['style', ['style']],
            ['fontstyle', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontcolor' ['fontcolor']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['media', ['link']]
        ],

        //Fix firefox popover
        popatmouse: false
    });
});

</script>

@endpush

