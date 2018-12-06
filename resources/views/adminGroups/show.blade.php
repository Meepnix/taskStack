@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Admin Groups</h2></div>
                <a style="margin-bottom: 1.5em;" href="{{ route('admin.group.create') }}" class="btn btn-primary">
                        <i class="fa fa-btn fa-plus-square"></i>Create Filter
                    </a>
                <div class="panel-body">
                    <div class="panel-body">

                        @foreach ($groups as $key => $group)

                        <div id="accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="heading{{ $key }}">
                                    <h5 class="mb-0">
                                        <h4>{{ $group->name }}</h4>
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteGroup{{ $key }}">
                                            <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body">

                                    @foreach ($group->users as $key => $user)

                                    <p>{{ $user->name }}</p>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{ $key }}">
                                            <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                                    </a>

                                    <!-- Delete User Modal -->
                                    <div class="modal fade" id="deleteUser{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Do you wish to continue and delete {{ $user->name }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.user.delete', [$user->id]) }}" method="POST">
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
                            </div>

                            <!-- Delete Group Modal -->
                            <div class="modal fade" id="deleteGroup{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Delete Group</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do you wish to continue and delete this Group?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.group.delete', [$group->id]) }}" method="POST">
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
</div>
                        
@endsection


