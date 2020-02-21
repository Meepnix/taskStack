@extends('layouts.main')

@push('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

@endpush

@section('content')

<div id="app">

    <div class="container">

    <div v-if="success" class="alert alert-success" role="alert">
            Task Created.
    </div>
    
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Create Task</h2>
                <hr>
            
                <form @submit.prevent="create">
                @csrf
                    
                    <div class="form-group">
                        <label for="title1">
                            <h5>
                                <strong>Title</strong>
                            </h5>
                        </label>
                        <input 
                        type="text" 
                        class="form-control" id="title1" 
                        name="title" 
                        value="{{ old('title') }}"
                        v-model="fields.title">
                        <br>
                    </div>

                    <div class="form-group">
                        <h5>
                            <strong>Tags</strong>
                        </h5>
                        @foreach( $labels as $label)
                    

                        <label for="{{ $label->id }}">{!! $label->html !!}</label>

                        <input 
                        id="{{ $label->id }}" 
                        name="label_check[]" 
                        type="checkbox" 
                        value="{{ $label->id }}"
                        v-model="fields.label_check"
                        style="margin-right: 10px;">
                        
                    
                        @endforeach
                    </div>


                    <div class="form-group">
                        <h5>
                            <strong>Content</strong>
                        </h5>
                        <textarea 
                        name="message" 
                        class="summernote" 
                        id="summernote">
                            {{ old('message') }}
                        </textarea>
                    </div>

                    <h5>
                        <strong>Attached PDFs</strong>
                    </h5>

                    <button 
                    type="button" 
                    class="btn btn-primary" 
                    data-toggle="modal" 
                    data-target="#fileselect">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> ADD PDF
                    </button>

                    <ul class="list-group" style="padding-top: 5px">
                        <list-file class="list-group-item list-group-item"
                        v-for="pdf in fields.links" 
                        v-bind:file="pdf" 
                        :key="pdf.id"
                        v-on:remove-link="removeLink">
                        </list-file>
  
                    </ul>


                    <hr>
                    <div class="float-right">
                        <a href="{{ route('admin.task.show') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                        
                    </div>

                </form>
            
                


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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-11">
                                            <h5 class="modal-title" id="image_Label">Select Image</h5>
                                            <button type="button" v-on:click="readImages" class="btn btn-secondary ml-1 mr-1"><i class="fas fa-sync"></i> Refresh</button>
                                            <a href="{{ route('admin.location.show')}}" target="_blank">Open PDFs and Images (new window)</a>
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-11">
                                            <h5 class="modal-title" id="file_Label">Select PDF</h5>
                                            <button type="button" v-on:click="readFiles" class="btn btn-secondary ml-1 mr-1"><i class="fas fa-sync"></i> Refresh</button>
                                            <a href="{{ route('admin.location.show')}}" target="_blank">Open PDFs and Images (new window)</a> 
                                        </diV>
                                        <div class="col-1">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    
                                    
                                <div class="accordion" id="accordion">
                                    <location-file
                                    v-for="pdf in files" 
                                    v-bind:file="pdf" 
                                    :key="pdf.id"
                                    v-on:add-link="addLink">
                                    </location-file>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ul>
                    <li v-for="error in errors">
                        @{{ error }}
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
                        
@endsection

@push('endscripts')

<script>
    //Pass site route
    var SiteRoute = "{{asset('')}}";
    var id = 0;
</script>

<script src="{{ asset('js/summer-custom-update.js') }}"></script>

@endpush


