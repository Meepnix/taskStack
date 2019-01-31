@extends('layouts.main')

@section('content')
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
                                    <div class= "col-10">
                                        <h4>{{ $location->name }}</h4>
                                    </div>
                                    <div class="col-2">
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteGroup{{ $loop->index }}">
                                            <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </h5>
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
                        
@endsection

