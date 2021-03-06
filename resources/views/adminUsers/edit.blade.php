@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Edit User</h3>
            <hr>

            <form method="POST" action="{{ route('admin.user.update', [$user->id]) }}">
            @csrf
            @method('PATCH')
            
                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                    id="name" 
                    type="text" 
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                    name="name" value="{{ $user->name }}" 
                    required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                {!! Form::label('groups', 'Groups:') !!}
                {!! Form::select('groups[]', 
                $curGroups, $setGroups, ['class' => 'form-control', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('permission', 'Permission:') !!}
                    {!! Form::select('permission', 
                    ['user' => 'User', 'admin' => 'Administrator'], $user->permission) !!}
                </div>
                

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                    id="password" 
                    type="password" 
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                    name="password" 
                    >

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>

                    <input 
                    id="password-confirm" 
                    type="password" 
                    class="form-control" 
                    name="password_confirmation" 
                    >
                
                </div>


                <hr>
                <div class="float-right">
                    <a href="{{ route('admin.group.show') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">SAVE</button>
                        
                </div>

            </form>


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


