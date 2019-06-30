@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Labels</h2>
            <p>
                <a href="{{ route('admin.dashboard.show') }}">Dashboard</a> >
                <a href="{{ route('admin.label.show') }}">
                    <strong>Labels</strong>
                </a>
            </p>
            
                <a style="margin-bottom: 1.5em;" 
                href="{{ route('admin.label.create') }}" 
                class="btn btn-primary">
                        <i class="fa fa-btn fa-plus-square"></i>CREATE LABEL
                </a>
                
                
  
            <!-- Label List -->
                
            <ul class="list-group">

            
            
            @foreach ($labels as $label)

                <li class="list-group-item">

                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                    
                                {!! $label->html !!}

                            </div>
                            <div class="col-5">
                                <p>

                                <a href="{{ route('admin.label.edit', [$label->id])}}" class="btn btn-primary">
                                    <i class="fa fa-btn fa-edit" 
                                    aria-hidden="true">
                                    </i>EDIT LABEL
                                </a>

                                <a href="#" class="btn btn-danger" 
                                data-toggle="modal" data-target="#deleteLabel{{ $loop->index }}">
                                    <i class="fa fa-btn fa-trash" 
                                    aria-hidden="true">
                                    </i>DELETE LABEL
                                </a>
                                </p>

                                <!-- Delete Label Modal -->
                                <div class="modal fade" id="deleteLabel{{ $loop->index }}" 
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Group</h5>
                                                <button type="button" class="close" data-dismiss="modal" 
                                                aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you wish to continue and delete {{ $label->name}} ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.label.delete', [$label->id]) }}" 
                                                method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    <button type="button" class="btn btn-secondary" 
                                                    data-dismiss="modal">
                                                    No
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                    Yes
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>


                

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
                        
@endsection


