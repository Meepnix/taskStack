@extends('layouts.main')

@section('content')
<div id="app">
<div class="container">

    @include('shared.flash')
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Create Slot</h2>

            <form method="POST" action="{{ route('admin.slot.store', [$group->id]) }}">
            @csrf
                        
                <div class="form-group">
                    <input type="checkbox" id="mon" v-model="mon" name="mon" :disabled="all" value="1">
                    <label for="mon">Monday</label>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="tue" v-model="tue" name="tue" :disabled="all" value="1">
                    <label for="tue">Tuesday</label>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="wed" v-model="wed" name="wed" :disabled="all" value="1">
                    <label for="wed">Wednesday</label>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="thu" v-model="thu" name="thu" :disabled="all" value="1">
                    <label for="thu">Thursday</label>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="fri" v-model="fri" name="fri" :disabled="all" value="1">
                    <label for="fri">Friday</label>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="all" v-model="all" name="all" value="1" v-on:click="resetDays">
                    <label for="all">All</label>
                </div>

                <div class="form-group">
                    {!! Form::label('time_period', 'Time Periods:') !!}
                    {!! Form::select('time_period', ['morning' => 'Morning', 'afternoon' => 'Afternoon', 'evening' => 'Evening']) !!}
                </div>
              

                <div class="form-group">
                    {!! Form::label('task_id', 'Tasks:') !!}
                    {!! Form::select('task_id', $curTask) !!}
                </div>


                <button type="submit">Save</button>

            </form>

            <a href="{{ route('admin.slot.show', [$group->id]) }}" class="btn btn-default">Back</a>

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

<script>

    var app = new Vue({
        el: '#app',
        data: {
            mon: {{ old('mon') ? 'true' : 'false' }},
            tue: {{ old('tue') ? 'true' : 'false' }},
            wed: {{ old('wed') ? 'true' : 'false' }},
            thu: {{ old('thu') ? 'true' : 'false' }},
            fri: {{ old('fri') ? 'true' : 'false' }},
            all: {{ old('all') ? 'true' : 'false' }},
        },
        methods: {
            resetDays: function () {
                this.mon = false
                this.tue = false
                this.wed = false
                this.thu = false
                this.fri = false
            }
        }
    })

</script>
                        
@endsection


