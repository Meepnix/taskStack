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
                <form method="POST" action="{{ route('admin.task.update', [$task->id]) }}">

                @csrf
                @method('PATCH')
                        
                    <div class="form-group">
                        <label for="title1">Title</label>
                        <input type="text" class="form-control" id="title1" name="title" value="{{ $task->title }}"><br>
                    </div>
                            
                    <div class="form-group">
                        <textarea name="message" class="summernote" id="summernote">{{ $task->message }}</textarea>
                    </div>

                    <button type="submit">Save</button>

                </form>
                        
                <a href="{{ route('admin.task.show') }}" class="btn btn-default">Back</a>


                <div class="modal fade" id="imgselect" tabindex="-1" role="dialog" aria-labelledby="image_label" aria-hidden="true">
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
                                    <location-card v-for="location in locations" v-bind:location="location" :key="location.id"></location-card>
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
// Summernotes

var ImageButton = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="fas fa-image"/>',
    tooltip: 'Insert Image',
    click: function () {
        // invoke image selection modal
        $('#imgselect').modal('show');
    }
  });

  return button.render();   // return button as jquery object
}


$(document).ready(function() {
    $('#summernote').summernote({

        toolbar: [
            ['image', ['image']],
            ['style', ['style']],
            ['fontstyle', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontcolor' ['fontcolor']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['media', ['link', 'video', 'hr']],
            ['view', ['codeview']]
        ],

        buttons: {
            image: ImageButton
        },

        //Fix firefox popover
        popatmouse: false,

        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ]
        }
    });
});

</script>

@endpush


@push('endscripts')


<script>
// Vue app

Vue.component('location-card', {
    props: ['location'],
    template: `
    <div class="card">
        <div class="card-header" v-bind:id="'heading' + location.id">
            <h5 class="mb-0">
                <h3>@{{ location.name }}</h3>
                    <button class="btn btn-link" type="button" data-toggle="collapse" v-bind:data-target="'#collapse' + location.id" aria-expanded="false" v-bind:aria-controls="'collapse' + location.id">
                        Click for more 
                    </button> 
            </h5> 
        </div> 
        <div v-bind:id="'collapse' + location.id" class="collapse" v-bind:aria-labelledby="'heading' + location.id" data-parent="#accordion">
        
            <div class="card-body">
                <table class="table"> 
                    <thead> 
                        <tr> 
                            <th scope="col">Filename</th> 
                        </tr>
                    </thead>
                    <tbody> 
                        <tr v-for="img in location.images" :key="img.id"> 
                            <td>@{{ img.name }}</td> 
                        </tr> 
                    </tbody> 
            </div> 
        </div>
    </div>`
    })

    var app = new Vue({
        el: '#app',
        data: {
            locations: null,
            errors: []
        },
        methods: {
            read: function () {
                axios.get('/admin/location/index/images').then( response => {
                    this.locations = response.data;
                })
                .catch(e => {
                    this.error.push(e);
                })
            }

        },
        created: function () {
            
            this.read();
        }
    })

    Vue.config.devtools = true;

</script>



@endpush






