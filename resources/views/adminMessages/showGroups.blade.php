@extends('layouts.main')

@section('content')

<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <h2>Messengers</h2>
            <p>
                <a href="{{ route('admin.dashboard.show') }}">Dashboard</a> >
                <a href="{{ route('admin.message.showGroups') }}"><strong>Messengers</strong></a>
            </p>
            
            <div class="card-columns">

                @foreach ($groups as $group)

                <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5>{{ $group->name }}</h5></div>
                    <div class="card-body">
                        <a 
                        style="margin-bottom: 1.5em;" 
                        href="{{ route('admin.message.edit', [$group->id]) }}" 
                        class="btn btn-primary">
                            <i class="fa fa-btn"></i>Open slots
                        </a>
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


