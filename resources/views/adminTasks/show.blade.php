@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <h2>Tasks</h2>
                <a style="margin-bottom: 1.5em;" href="{{ route('admin.task.create') }}" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus-square"></i>Create New Task
                </a>
                

            

            <div class="accordion" id="accordionTask">

            @foreach ($tasks as $task)
            
                <div class="card">
                    <div class="card-header" id="heading{{ $loop->index }}">
                        <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index}}" aria-expanded="false" aria-controls="collapse{{ $loop->index}}">                            
                            {{ $task->title }}
                        </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $loop->index}}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionTask">

                        <div class="card-body">
                            <p>{!! $task->message !!}</p>

                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteTask{{ $loop->index }}">
                                <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                            </a>
                            <a href="{{ route('admin.task.edit', [$task->id]) }}" class="btn btn-secondary">
                                <i class="fa fa-btn fa-edit" aria-hidden="true"></i>Edit
                            </a>
                            <!-- Delete User Modal -->
                            <div class="modal fade" id="deleteTask{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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


