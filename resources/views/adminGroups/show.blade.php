@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Groups</h2>
                <a style="margin-bottom: 1.5em;" href="{{ route('admin.group.create') }}" class="btn btn-primary">
                        <i class="fa fa-btn fa-plus-square"></i>Create New Group
                </a>
                
                   
                <!-- Group Cards -->
                
                @foreach ($groups as $group)

                <div class="accordion" id="accordionGroup">
                    <div class="card">
                        <div class="card-header" id="heading{{ $loop->index }}">
                            <h5 class="mb-0">
                                <div class="container">
                                    <div class="row">
                                        <div class= "col-10">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index}}" aria-expanded="false" aria-controls="collapse{{ $loop->index}}">                            
                                                {{ $group->name }}
                                            </button>
                                            
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
                        <div id="collapse{{ $loop->index}}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionGroup">

                            <div class="card-body">
                                <a style="margin-bottom: 1.5em;" href="{{ route('admin.user.create', [$group->id]) }}" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus-square"></i>Create New User
                                </a>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Group</th>
                                            <th scope="col">Username</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                <!-- Group Users table -->

                                @foreach ($group->users as $user)

                                        <tr>
                                            <td><p>{{ $group->name }}</p></td>
                                            <td><p>{{ $user->name }}</p></td>
                                            <td>
                                        
                                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{ $loop->index }}">
                                                    <i class="fa fa-btn fa-trash" aria-hidden="true"></i>Delete
                                                </a>
                                                <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn btn-secondary">
                                                    <i class="fa fa-btn fa-pencil" aria-hidden="true"></i>Edit
                                                </a>

                                                <!-- Delete User Modal -->
                                                <div class="modal fade" id="deleteUser{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Group Modal -->
                    <div class="modal fade" id="deleteGroup{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Group</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you wish to continue and delete {{ $group->name}} ?
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
                        
@endsection


