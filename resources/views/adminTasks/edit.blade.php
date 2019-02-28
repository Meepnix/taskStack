@extends('layouts.main')


@push('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

@endpush

@section('content')

<div id="images">

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

var HelloButton = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="fa fa-child"/> Hello',
    tooltip: 'hello',
    click: function () {
      // invoke insertText method with 'hello' on editor module.
      context.invoke('editor.insertText', 'hello');
    }
  });

  return button.render();   // return button as jquery object
}


$(document).ready(function() {
    $('#summernote').summernote({

        toolbar: [
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
            hello: HelloButton
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


@push('endscript')





<script>
// Vue app

Vue.component('blog-post', {
  props: ['title'],
  template: '<h3>{{ title }}</h3>'
})


//https://stackoverflow.com/questions/38950653/vuejs-component-inside-of-v-for


    var app = new Vue({
        el: '#images',
        data: {
            options: {
                height: "600px",
                width: "100%",
            },
            path: null,
        },
        methods: {
            submitFile: function (path) {

                PDFObject.embed(path, "#pdf", this.options);
                $('#pdfview').modal('show');
                
            },
            submitImage: function (path) {

                this.path = path;
                $('#imageview').modal('show');
            }
        }
    })

</script>



@endpush






