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
            <h2>File locations</h2>
            <p>
                <a href="{{ route('admin.dashboard.show') }}">Dashboard</a> >
                <a href="{{ route('admin.location.show') }}"><strong>File locations</strong></a>
            </p>

            <a style="margin-bottom: 1.5em;" href="{{ route('admin.location.create') }}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus-square"></i>CREATE FILE LOCATION
            </a>
                
            <!-- Location Cards -->

            

            <div class="accordion" id="accordionLocation">
            
            @foreach ($locations as $location)

                <div class="card">
                    <div class="card-header" id="heading{{ $loop->index }}">
                        <h5 class="mb-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-link collapsed" 
                                        type="button" data-toggle="collapse" 
                                        data-target="#collapse{{ $loop->index}}" 
                                        aria-expanded="false" 
                                        aria-controls="collapse{{ $loop->index}}">                            
                                            {{ $location->name }}
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">

                                    </div>
                                </div>
                            </div>
                        </h5>
                    </div>

                    <div id="collapse{{ $loop->index}}" 
                    class="collapse" 
                    aria-labelledby="heading{{ $loop->index }}" 
                    data-parent="#accordionLocation">

                        <div class="card-body">
                            <div class="container">
                                <div class="row">

                                    <!-- PDF Table -->
                                    <div class="col">
                                    <h4>PDF files</h4>
                                    </div>

                                    <div class="col">
                                
                                        <a href="{{ route('admin.file.create', [$location->id]) }}" 
                                        class="btn btn-secondary btn-sm">
                                            <i class="fa fa-btn fa-upload fa-sm" aria-hidden="true"></i>UPLOAD PDF
                                        </a>
                                    </div>
                                

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
                                                <td class="text-right">
                                                    <a href="#" 
                                                    v-on:click="submitFile('{{ asset('storage' . $file->public_path) }}')">
                                                        <i class="fa fa-btn fa-file-pdf" aria-hidden="true"></i>OPEN
                                                    </a>
                                                    &nbsp;
                                                    <a href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteFile{{ $location->id + $loop->index }}">
                                                        <i class="fa fa-btn fa-trash" aria-hidden="true"></i>DELETE
                                                    </a>
                                            
                                                    <!-- Delete File Modal -->
                                                    <div 
                                                    class="modal fade" 
                                                    id="deleteFile{{ $location->id + $loop->index }}" 
                                                    tabindex="-1" 
                                                    role="dialog" 
                                                    aria-labelledby="exampleModalLabel" 
                                                    aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 
                                                                    class="modal-title" 
                                                                    id="exampleModalLabel">Delete PDF file
                                                                    </h5>
                                                                    <button type="button" 
                                                                    class="close" 
                                                                    data-dismiss="modal" 
                                                                    aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do you wish to continue and delete {{ $file->name}} ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form 
                                                                    action="{{ route('admin.file.delete', [$file->id]) }}" 
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                
                                                                        <button 
                                                                        type="button" 
                                                                        class="btn btn-secondary" 
                                                                        data-dismiss="modal">No
                                                                        </button>
                                                                        <button 
                                                                        type="submit" 
                                                                        class="btn btn-danger">Yes
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
                                    <div 
                                    class="modal fade" 
                                    id="pdfview" 
                                    tabindex="-1" 
                                    role="dialog" 
                                    aria-labelledby="exampleModalLabel" 
                                    aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View PDF</h5>
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


                                    <!-- Image Table -->
                                    <div class="col">
                                        <h4>Image files</h4>
                                    </div>

                                    <div class="col">
                                        <a 
                                        href="{{ route('admin.image.create', [$location->id]) }}" 
                                        class="btn btn-secondary btn-sm">
                                            <i class="fa fa-btn fa-upload fa-sm" aria-hidden="true"></i>UPLOAD IMAGE
                                        </a>

                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Filename</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Size</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        @foreach ($location->images as $image)

                                            <tr>
                                                <td>{{ $image->name }}</td>
                                                <td>{{ $image->type }}</td>
                                                <td>{{ $image->size }}</td>
                                                <td class="text-right">
                                                    <a 
                                                    href="#" 
                                                    v-on:click="submitImage('{{ asset('storage' . $image->public_path) }}')">
                                                        <i class="fa fa-btn fa-images" aria-hidden="true"></i>OPEN
                                                    </a>
                                                    &nbsp;
                                                    <a 
                                                    href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteImage{{ $location->id + $loop->index }}">
                                                        <i class="fa fa-btn fa-trash" aria-hidden="true"></i>DELETE
                                                    </a>
                                                
                                                    <!-- Delete File Modal -->
                                                    <div 
                                                    class="modal fade" 
                                                    id="deleteImage{{ $location->id + $loop->index }}" 
                                                    tabindex="-1" 
                                                    role="dialog" 
                                                    aria-labelledby="exampleModalLabel" 
                                                    aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 
                                                                    class="modal-title" 
                                                                    id="exampleModalLabel">Delete PDF file</h5>
                                                                    <button 
                                                                    type="button" 
                                                                    class="close" 
                                                                    data-dismiss="modal" 
                                                                    aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do you wish to continue and delete 
                                                                    {{ $image->name}} ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form 
                                                                    action="{{ route('admin.image.delete', [$image->id]) }}" 
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                    
                                                                        <button 
                                                                        type="button" 
                                                                        class="btn btn-secondary" 
                                                                        data-dismiss="modal">No
                                                                        </button>
                                                                        <button 
                                                                        type="submit" 
                                                                        class="btn btn-danger">Yes
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

                                    <!-- View Image -->
                                    <div 
                                    class="modal fade" 
                                    id="imageview" 
                                    tabindex="-1" 
                                    role="dialog" 
                                    aria-labelledby="exampleModalLabel" 
                                    aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Image</h5>
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
                                                        <img v-bind:src="path" height="100%" width="100%">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer">

                            <a 
                            href="#" 
                            class="btn btn-danger" 
                            data-toggle="modal" 
                            data-target="#deleteGroup{{ $loop->index }}">
                                <i class="fa fa-btn fa-trash" aria-hidden="true"></i>DELETE LOCATION
                            </a>
                            &nbsp;
                            <a href="{{ route('admin.location.edit', [$location->id]) }}" class="btn btn-secondary">
                                <i class="fa fa-btn fa-edit" aria-hidden="true"></i>CHANGE LOCATION NAME
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Delete Location Modal -->
                <div 
                class="modal fade" 
                id="deleteGroup{{ $loop->index }}" 
                tabindex="-1" role="dialog" 
                aria-labelledby="exampleModalLabel" 
                aria-hidden="true">
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

            @endforeach
            
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
            submitImage: function (path) {

                this.path = path;
                $('#imageview').modal('show');
            }
        }
    })

</script>
                        
@endsection


