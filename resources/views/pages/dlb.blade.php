@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Your Downline Builder

@stop


@section('content')

    <div class="form-page-large">

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{--  PROGRAMS --}}

        {{--  NEW PROGRAM --}}
        <h2>Add Your Favorite Programs!</h2>
        {{ Form::open(array('route' => array('dlb.store'), 'method' => 'POST')) }}
        <div class="form-group">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">{{ Form::label('name', 'Program Name: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-7">
                    {{ Form::text('name', old('name'), array('placeholder' => 'program name', 'class' => 'form-control')) }}
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">{{ Form::label('url', 'Program URL: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-7">
                    {{ Form::text('url', old('url'), array('placeholder' => 'http://', 'class' => 'form-control')) }}
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">{{ Form::label('bold', 'Bold: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-7 text-left">
                    {{ Form::checkbox('bold', '1', old('bold')) }}
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">{{ Form::label('color', 'Color: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-7">
                    {{ Form::select('color', array('black' => 'Black', 'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple', 'orange' => 'Orange', 'pink' => 'Pink'),
                    old('color'), array('class' => 'form-control')) }}
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">{{ Form::label('desc', 'Description: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-7">
                    {{ Form::textarea('desc', old('desc'), array('placeholder' => 'program description', 'size' => '45x5', 'class' => 'form-control')) }}
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">{{ Form::label('category', 'Category: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-7">
                    <select name="category" class="form-control">
                        <option value="" disabled selected>Select program category</option>
                        @foreach ($categories as $category)
                            @if($category->id == old('category'))
                                <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    {{ Form::submit('Create', array('name' => 'createprogram', 'class' => 'btn btn-custom')) }}
                    {{ Form::close() }}
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <br>

        {{--  EXISTING PROGRAMS --}}
        <div class="table-responsive">
            <h2>Your Downline Builder Programs</h2>
            <div>Your programs are shown in the builder from the lowest to highest "Order" under their own category.</div><br><br>
            <table class="table table-hover table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th>Reorder</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Bold</th>
                    <th>Color</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody id="myprogramstbody">

                @foreach ($userprograms as $userprogram)
                    <tr id="ID_{{ $userprogram->id }}">
                        {{ Form::open(array('route' => array('dlb.update', $userprogram->id), 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form' . $userprogram->id, 'name' =>  'form' . $userprogram->id)) }}
                        {{ Form::hidden('positionnumber' . $userprogram->id, $userprograms_id_order, ['id' => 'positionnumber' . $userprogram->id]) }}
                        <td><i class="fa fa-reorder"></i></td>
                        <td>{{ $userprogram->id }}</td>
                        <td>{{ Form::text('name' . $userprogram->id, $userprogram->name, array('placeholder' => 'program name', 'class' => 'form-control')) }} </td>
                        <td>{{ Form::textarea('desc' . $userprogram->id, $userprogram->desc, array('placeholder' => 'program description', 'size' => '30x3', 'class' => 'form-control')) }} </td>
                        <td>{{ Form::text('url' . $userprogram->id, $userprogram->url, array('placeholder' => 'http://', 'class' => 'form-control')) }} </td>
                        <td>{{ Form::checkbox('bold' . $userprogram->id, '1', $userprogram->bold) }}</td>
                        <td>{{ Form::select('color' . $userprogram->id, array('black' => 'Black', 'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple', 'orange' => 'Orange', 'pink' => 'Pink'),
                        $userprogram->color, array('class' => 'form-control')) }} </td>
                        <td>
                            <select name="category{{ $userprogram->id }}" class="form-control">
                                @foreach($categories as $category)
                                    @if($userprogram->category == $category->id)
                                        <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td class='priority'>{{ $userprogram->positionnumber }}</td>
                        <td>{{ Form::submit('Save', array('name' => 'saveprogram','class' => 'btn btn-custom skinny')) }}</td>
                        {{ Form::close() }}
                        <td>
                            {{ Form::open(array('route' => array('admin.dlb.destroy', $userprogram->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                            {{ Form::submit('Delete', array('name' => 'deleteprogram','class' => 'btn btn-custom skinny')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
        <br>


            {{--  BUILDER PROGRAMS FOR THIS USER TO JOIN --}}

            <div class="container">
                <h2>Join Sponsor Builder Programs</h2>
                <div>Join your sponsor's programs below then add them with your own affiliate URLs as your own Downline Builder programs. Your referrals will then see and join them under your signup links.</div><br><br>
                <ul class="nav nav-tabs">
                    @foreach($categories as $category)
                        <li><a data-toggle="tab" href="#page{{ $category->id }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($categories as $category)
                        <div id="page{{ $category->id }}" class="tab-pane fade">
                        {{-- GET SPONSORS PROGRAMS --}}
                        @foreach($sponsorprograms as $sponsorprogram)
                            @if($sponsorprogram->category == $category->id)
                                    <div class="panel panel-default text-left">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="{{ $sponsorprogram->url }}" target="_blank">
                                                @if ($sponsorprogram->bold == 1)
                                                    <strong>
                                                        @if(empty($sponsorprogram->color))
                                                             {{ $sponsorprogram->name }}
                                                        @else
                                                            <span style="color: {{ $sponsorprogram->color }}">{{ $sponsorprogram->name }}</span>
                                                        @endif
                                                    </strong>
                                                @else
                                                        @if(empty($sponsorprogram->color))
                                                            {{ $sponsorprogram->name }}
                                                        @else
                                                            <span style="color: {{ $sponsorprogram->color }}">{{ $sponsorprogram->name }}</span>
                                                        @endif
                                                @endif
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>{{ $sponsorprogram->desc }}</p>
                                        </div>
                                    </div>
                            @endif
                        @endforeach

                        {{-- GET ADMIN PROGRAMS --}}
                        @foreach($adminprograms as $adminprogram)
                            @if($adminprogram->category == $category->id)
                                <div class="panel panel-default text-left">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="{{ $adminprogram->url }}" target="_blank">
                                                @if ($adminprogram->bold == 1)
                                                    <strong>
                                                        @if(empty($adminprogram->color))
                                                            {{ $adminprogram->name }}
                                                        @else
                                                            <span style="color: {{ $adminprogram->color }}">{{ $adminprogram->name }}</span>
                                                        @endif
                                                    </strong>
                                                @else
                                                    @if(empty($adminprogram->color))
                                                        {{ $adminprogram->name }}
                                                    @else
                                                        <span style="color: {{ $adminprogram->color }}">{{ $adminprogram->name }}</span>
                                                    @endif
                                                @endif
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <p>{{ $adminprogram->desc }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    @endforeach
                </div>

            </div>



    </div>

    <script>
        // reorder the category numbers.
        $( "#myprogramstbody" ).sortable({
            opacity: 0.6,
            cursor: 'move',
            stop: function( event, ui ){
                $(this).find('tr').each(function(i){
                    var pn = i+1;
                    // update the text in the order column to show the order that the categories will appear to people.
                    $(this).find('td:nth-last-child(3)').text(pn);
                    var order = $("#myprogramstbody").sortable("serialize");
                    $(this).find("input[type=hidden]:eq(2)").val(order);
                    //var v = $(this).find("input[type=hidden]:eq(2)").val();
                    //alert(v);
                });
            }
        });
    </script>


@stop


@section('footer')



@stop