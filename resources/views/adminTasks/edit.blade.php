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
                <h2>Edit Task</h2>
                <form @submit.prevent="submit">

                @csrf
                @method('PATCH')
                        
                    <div class="form-group">
                        <label for="title1">Title</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="title1" 
                        name="title" 
                        value="{{ $task->title }}"
                        v-model="fields.title">
                        <br>
                    </div>

                    <div class="form-group">
                        <h5>Tags:</h5>
                        @foreach( $labels as $label)
                    

                            <label for="{{ $label->id }}">{!! $label->html !!}</label>

                            <input id="{{ $label->id }}" 
                            name="label_check[]" 
                            type="checkbox" 
                            value="{{ $label->id }}"
                            v-model="fields.label_check"
                            {{ $label_chks->contains('id', $label->id) ? 'checked' : ''}} >
                        
                        @endforeach
                    </div>

                            
                    <div class="form-group">
                        <textarea name="message" class="summernote" id="summernote">{{ $task->message }}</textarea>
                    </div>

                    <button type="submit">Save</button>

                </form>
                        
                <a href="{{ route('admin.task.show') }}" class="btn btn-default">Back</a>

                <!-- Insert image modal from summernote -->
                <div 
                class="modal fade" 
                id="imgselect" 
                tabindex="-1" 
                role="dialog" 
                aria-labelledby="image_label" 
                aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="image_Label">Select Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    
                                    
                                <div class="accordion" id="accordion">
                                    <location-image 
                                    v-for="img in images" 
                                    v-bind:image="img" 
                                    :key="img.id">
                                    </location-image>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Insert file modal from summernote -->
                <div 
                class="modal fade" 
                id="fileselect" 
                tabindex="-1" 
                role="dialog" 
                aria-labelledby="file_label" 
                aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="file_Label">Select PDF</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    
                                    
                                <div class="accordion" id="accordion">
                                    <location-file
                                    v-for="pdf in files" 
                                    v-bind:file="pdf" 
                                    :key="pdf.id">
                                    </location-file>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
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

@endsection

@push('endscripts')

<script>
    //Pass site route
    var SiteRoute = "{{asset('')}}";
    var id = "{{$task->id}}";
</script>

<script src="{{ asset('js/summer-custom-update.js') }}"></script>

@endpush