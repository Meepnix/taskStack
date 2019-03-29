@extends('layouts.main')

@section('content')

<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <h2>{{ $group->name }} Slots</h2>
            <p>
                <a href="{{ route('admin.dashboard.show') }}">Dashboard</a> >
                <a href="{{ route('admin.slot.showGroups') }}">Slots</a> > 
                <a href="{{ url()->current() }}"><strong>{{ $group->name }} Slots<strong></a>
            </p>
            <a style="margin-bottom: 1.5em;" href="{{ route('admin.slot.create', [$group->id]) }}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus-square"></i>CREATE SLOT
            </a>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-morning-tab" data-toggle="tab" href="#nav-morning" role="tab" aria-controls="nav-morning" aria-selected="true">Morning</a>
                    <a class="nav-item nav-link" id="nav-afternoon-tab" data-toggle="tab" href="#nav-afternoon" role="tab" aria-controls="nav-afternoon" aria-selected="false">Afternoon</a>
                    <a class="nav-item nav-link" id="nav-evening-tab" data-toggle="tab" href="#nav-evening" role="tab" aria-controls="nav-evening" aria-selected="false">Evening</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-morning" role="tabpanel" aria-labelledby="nav-morning-tab">
                            
                    
                @foreach ($mornings as $slot)

                    @include('partials.slot')
    
                @endforeach
    
                            
                </div>
                       
                <div class="tab-pane fade" id="nav-afternoon" role="tabpanel" aria-labelledby="nav-afternoon-tab">
                            
                
                @foreach ($afternoons as $slot)

                    @include('partials.slot')

                @endforeach

                            
                </div>

                <div class="tab-pane fade" id="nav-evening" role="tabpanel" aria-labelledby="nav-evening-tab">
                            
                @foreach ($evenings as $slot)

                    @include('partials.slot')

                @endforeach
                            
                </div>
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


