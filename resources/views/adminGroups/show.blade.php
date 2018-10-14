@extends('layout.main')

@section('content')
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Admin Groups</h2></div>
                <div class="panel-body">
                    <div class="panel-body">

                        @foreach ($groups as $key => $group)

                        <div id="accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="heading{{ $key }}">
                                    <h5 class="mb-0">
                                        <h4>{{ $group->name }}</h4>
                                    </h5>
                                </div>
                                <div class="card-body">

                                    @foreach ($group->users as $user)

                                    <p>{{ $user->name }}</p>

                                    @endforeach

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


