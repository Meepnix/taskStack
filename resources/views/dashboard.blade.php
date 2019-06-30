@extends('layouts.main')

@section('content')

<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <h2>Dashboard</h2>
            <div class="card-columns">

                <!--Groups-->
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5>Groups</h5></div>
                    <div class="card-body">
                        <a 
                        style="margin-bottom: 1.5em;" 
                        href="{{ route('admin.group.show') }}" 
                        class="btn btn-primary">
                            Open
                        </a>
                    </div>
                </div>

                <!--Tasks-->
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5>Tasks</h5></div>
                    <div class="card-body">
                        <a 
                        style="margin-bottom: 1.5em;" 
                        href="{{ route('admin.task.show') }}" 
                        class="btn btn-primary">
                            Open
                        </a>
                    </div>
                </div>

                 <!--Slots-->
                 <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5>Slots</h5></div>
                    <div class="card-body">
                        <a 
                        style="margin-bottom: 1.5em;" 
                        href="{{ route('admin.slot.showGroups') }}" 
                        class="btn btn-primary">
                            Open
                        </a>
                    </div>
                </div>
                
                <!--Location-->
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5>Locations</h5></div>
                    <div class="card-body">
                        <a 
                        style="margin-bottom: 1.5em;" 
                        href="{{ route('admin.location.show') }}" 
                        class="btn btn-primary">
                            Open
                        </a>
                    </div>
                </div>

                <!--Label-->
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h5>Labels</h5></div>
                    <div class="card-body">
                        <a 
                        style="margin-bottom: 1.5em;" 
                        href="{{ route('admin.label.show') }}" 
                        class="btn btn-primary">
                            Open
                        </a>
                    </div>
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


