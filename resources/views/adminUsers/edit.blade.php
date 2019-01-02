@extends('layouts.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Admin</h2></div>
                <div class="panel-body">
                    <div class="panel-body">

                        <h3>Edit User</h3>

                        <form method="POST" action="{{ route('admin.user.update', [$user->id]) }}">
                        @csrf
                        @method('PATCH')
                        
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                            {!! Form::label('groups', 'Groups:') !!}
                            {!! Form::select('groups[]', $curGroups, $setGroups, ['class' => 'form-control', 'multiple']) !!}
                            </div>
                            


                            <button type="submit">Save</button>

                        </form>
                        <a href="{{ route('admin.group.show') }}" class="btn btn-default">Back</a>

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


