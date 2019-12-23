@extends('layouts.main')

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>

@endpush

@section('content')

<div id="app">

<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            
            <h2>Tasks</h2>
            <p>
                <a href="{{ route('admin.dashboard.show') }}">Dashboard</a> >
                <a href="{{ route('admin.task.show') }}"><strong>Tasks</strong></a>
            </p>


            <a style="margin-bottom: 1.5em;" href="{{ route('admin.task.create') }}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus-square"></i>CREATE TASK
            </a>
        
            <div class="accordion" id="accordionTask">

            @foreach ($tasks as $task)
            
                <div class="card">
                    <div class="card-header" id="heading{{ $loop->index }}">
                        <h5 class="mb-0">

                            <div class="container">
                                <div class="row">
                                    <div class="col-8">

                                        <button 
                                        class="btn btn-link collapsed" 
                                        type="button" 
                                        data-toggle="collapse" 
                                        data-target="#collapse{{ $loop->index}}" 
                                        aria-expanded="false" 
                                        aria-controls="collapse{{ $loop->index}}">                            
                                        {{ $task->title }}
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('admin.task.edit', [$task->id]) }}" class="btn btn-secondary">
                                            <i class="fa fa-btn fa-edit" aria-hidden="true"></i>EDIT
                                        </a>
                                        &nbsp;
                                        <a 
                                        href="#" 
                                        class="btn btn-danger" 
                                        data-toggle="modal" 
                                        data-target="#deleteTask{{ $loop->index }}">
                                            <i class="fa fa-btn fa-trash" aria-hidden="true"></i>DELETE
                                        </a>
                                        <!-- Delete User Modal -->
                                        <div 
                                        class="modal fade" 
                                        id="deleteTask{{ $loop->index }}" 
                                        tabindex="-1" 
                                        role="dialog" 
                                        aria-labelledby="exampleModalLabel" 
                                        aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
                                                            <button 
                                                            type="button" 
                                                            class="close" 
                                                            data-dismiss="modal" 
                                                            aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you wish to continue and delete {{ $task->title }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.task.delete', [$task->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                            
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Yes
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </h5>
                    </div>

                    <div 
                    id="collapse{{ $loop->index}}" 
                    class="collapse" 
                    aria-labelledby="heading{{ $loop->index }}" 
                    data-parent="#accordionTask">
                        
                        
                        <div class="card-body">
                            <!-- Tags -->
                            <div class="card border-primary mb-3">
                                <div class="card-header">
                                    <h5>
                                        <strong>Tags</strong>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                @foreach ($task->labels as $label)
                                    
                                    <label>
                                    {!! $label->html !!}
                                    </label>
                                
                                @endforeach
                                </div>
                            </div>
                            <!-- Contents -->
                            <div class="card border-primary mb-3">
                                <div class="card-header">
                                    <h5>
                                        <strong>Contents</strong>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p>{!! $task->message !!}</p>
                                </div>
                            </div>
                            <!-- Attached PDFs -->
                            <div class="card border-primary mb-3">
                                <div class="card-header">
                                    <h5>
                                        <strong>Attached PDFs</strong>
                                    </h5>
                                </div>
                                <div class="card-body">
                                @foreach ($task->files as $file)
                                    <button
                                    type="button"
                                    v-on:click="submitFile('{{ asset('storage' . $file->public_path) }}')"
                                    class="btn btn-primary">
                                        <i class="fa fa-btn fa-file-pdf" aria-hidden="true"></i>{{ $file->name }}
                                    </button>
                                @endforeach
                                </div>
                            </div>



                        </div>
                        <div class="card-footer">


                          
                            
                        </div>
                    </div>
                </div>

            @endforeach

            </div>


            <!-- View PDF -->
            <div 
            class="modal fade" 
            id="pdfview" 
            tabindex="-1" 
            role="dialog" 
            aria-labelledby="view_pdf" 
            aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="view_pdf">View PDF</h5>
                            <button 
                            type="button" 
                            class="close" 
                            data-dismiss="modal" 
                            aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div id="pdf"></div>
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


<script>

    var app = new Vue({
        el: '#app',
        data: {
            options: {
                height: "600px",
                width: "100%",
            },
            path: null
        },
        methods: {
            submitFile: function (path) {

                PDFObject.embed(path, "#pdf", this.options);
                $('#pdfview').modal('show');
                
            },
        }
    })

</script>
                        
@endsection


