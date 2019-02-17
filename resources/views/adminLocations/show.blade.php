@extends('layouts.main')


@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>

@endpush


@section('content')

<div id="app">

<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Locations</h2>
            <a style="margin-bottom: 1.5em;" href="{{ route('admin.location.create') }}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus-square"></i>Create New Location
            </a>
                
            <!-- Location Cards -->
                        
            @foreach ($locations as $location)

            <div id="accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="heading{{ $loop->index }}">
                        <h5 class="mb-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-8">
                                        <h4>{{ $location->name }}</h4>
                                    </div>
                                    <div class="col-4">
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteGroup{{ $loop->index }}">
                                            <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                                        </a>
                                        <a href="{{ route('admin.location.edit', [$location->id]) }}" class="btn btn-secondary">
                                            <i class="fa fa-btn fa-pencil" aria-hidden="true"></i>Edit
                                        </a>

                                        <a href="{{ route('admin.file.create', [$location->id]) }}" class="btn btn-secondary">
                                            <i class="fa fa-btn fa-pencil" aria-hidden="true"></i>Upload file
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <h4>PDF files</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Filename</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Size</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    @foreach ($location->files as $file)

                                        <tr>
                                            <td>{{ $file->name }}</td>
                                            <td>{{ $file->type }}</td>
                                            <td>{{ $file->size }}</td>
                                            <td>
                                                <a href="#" class="btn btn-secondary" v-on:click="submitFile('{{ asset('storage/' . $file->public_path) }}')">
                                                    <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Open
                                                </a>

                                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteFile{{ $location->id + $loop->index }}">
                                                    <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                                                </a>
                                            
                                                <!-- Delete File Modal -->
                                                <div class="modal fade" id="deleteFile{{ $location->id + $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Location</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Do you wish to continue and delete {{ $file->name}} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.file.delete', [$file->id]) }}" method="POST">
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
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>

                                <!-- View PDF -->
                                <div class="modal fade" id="pdfview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">View PDF</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Location Modal -->
                <div class="modal fade" id="deleteGroup{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Location</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Do you wish to continue and delete {{ $location->name}} ?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('admin.location.delete', [$location->id]) }}" method="POST">
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

            @endforeach

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
        },
        methods: {
            submitFile: function (path) {

                PDFObject.embed(path, "#pdf", this.options);
                $('#pdfview').modal('show');
                
            }
        }
    })

</script>
                        
@endsection


