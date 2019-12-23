@extends('layouts.main')

@section('content')
<div id="app">
    <div class="container">

        @include('shared.flash')
        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            
                <h3>Create Label</h3>
                <hr>

                <form method="POST" 
                action="{{ route('admin.label.update', [$label->id]) }}">
                @csrf
                @method('PATCH')  
                
                    <div class="form-group">
                        <label for="name1">Name</label>
                        <input type="text" class="form-control" 
                        id="name1" name="name" 
                        value="{{ $label->name }}" v-model="name">
                        <br>
                    </div>

                    <div class="form-group">
                        <label for="label1">Label type:</label>
                        <select id="label1" name="label_fmt" v-model="selected" v-on:change="previewLabel" :disabled="!name">
                            <option value="0" selected>
                                Primary
                            </option>
                            <option value="1">
                                Secondary
                            </option>
                            <option value="2">
                                Success
                            </option>
                            <option value="3">
                                danger
                            </option>
                            <option value="4">
                                warning
                            </option>
                            <option value="5">
                                info
                            </option>
                        </select>

                        <span v-html="labelHtml"></span>

                    </div>

                    <hr>
                    <div class="float-right">
                        <a href="{{ route('admin.label.show') }}"  class="btn btn-outline-secondary">Cancel</a>
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
</div>

<script>

    var app = new Vue({
        el: '#app',
        data: {
            selected: '{{ $label->theme }}',
            name: '{{ $label->name }}',
            labelHtml: '',
        },
        created: function () {
            this.labelHtml = '{!! $label->html !!}'
        },
        computed: {
            previewLabel: function () {
                switch(this.selected){
                    case '0':
                        this.labelHtml = '<h5><span class="badge badge-primary">' + this.name + '</span></h5>'
                        break
                    case '1':
                        this.labelHtml = '<h5><span class="badge badge-secondary">' + this.name + '</span></h5>'
                        break
                    case '2':
                        this.labelHtml = '<h5><span class="badge badge-success">' + this.name + '</span></h5>'
                        break
                    case '3':
                        this.labelHtml = '<h5><span class="badge badge-danger">' + this.name + '</span></h5>'
                        break
                    case '4':
                        this.labelHtml = '<h5><span class="badge badge-warning">' + this.name + '</span></h5>'
                        break
                    case '5':
                        this.labelHtml = '<h5><span class="badge badge-info">' + this.name + '</span></h5>'
                        break
                }

            }
        }
    })

    Vue.config.devtools = true;

</script>
                        
@endsection


