@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Downline Builder

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

    {{--  CATEGORIES --}}

    {{--  NEW CATEGORY --}}
    <h2>Create New Builder Program Category</h2>
    {{ Form::open(array('route' => array('admin.dlb.store'), 'method' => 'POST')) }}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">{{ Form::label('name', 'Category Name: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-6">
                        {{ Form::text('name', old('name'), array('placeholder' => 'category name', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1">
                        {{ Form::submit('Create', array('name' => 'createcategory', 'class' => 'btn btn-custom skinny')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <br>

    {{--  EXISTING CATEGORIES --}}
            <div class="table-responsive">
                <h2>Builder Categories</h2>
                <table class="table table-hover table-condensed table-bordered text-center">
                    <thead>
                    <tr>
                        <th>Reorder</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Order</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="categoriestbody">

                    @foreach ($categories as $category)
                        <tr id="ID_{{ $category->id }}">
                            {{ Form::open(array('route' => array('admin.dlb.update', $category->id), 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form' . $category->id, 'name' =>  'form' . $category->id)) }}
                            {{ Form::hidden('positionnumber' . $category->id, $categories_id_order, ['id' => 'positionnumber' . $category->id]) }}
                            <td><i class="fa fa-reorder"></i></td>
                            <td>{{ $category->id }}</td>
                            <td>{{ Form::text('name' . $category->id, $category->name, array('placeholder' => 'category name', 'class' => 'form-control')) }} </td>
                            <td class='priority'>{{ $category->positionnumber }}</td>
                            <td>{{ Form::submit('Save', array('name' => 'savecategory','class' => 'btn btn-custom skinny')) }}</td>
                            {{ Form::close() }}
                            <td>
                                {{ Form::open(array('route' => array('admin.dlb.destroy', $category->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                                {{ Form::submit('Delete', array('name' => 'deletecategory','class' => 'btn btn-custom skinny')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            <br>


    {{--  PROGRAMS --}}

    {{--  NEW PROGRAM --}}
        <h2>Add New Downline Builder Program</h2>
        {{ Form::open(array('route' => array('admin.dlb.store'), 'method' => 'POST')) }}
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                <h2>Existing Downline Builder Programs</h2>
                <div>In the members area, programs are shown from the lowest to highest "Order" under their own category.</div><br><br>
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
                    <tbody id="programstbody">

                    @foreach ($programs as $program)
                        <tr id="ID_{{ $program->id }}">
                            {{ Form::open(array('route' => array('admin.dlb.update', $program->id), 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form' . $program->id, 'name' =>  'form' . $program->id)) }}
                            {{ Form::hidden('positionnumber' . $program->id, $programs_id_order, ['id' => 'positionnumber' . $program->id]) }}
                            <td><i class="fa fa-reorder"></i></td>
                            <td>{{ $program->id }}</td>
                            <td>{{ Form::text('name' . $program->id, $program->name, array('placeholder' => 'program name', 'class' => 'form-control')) }} </td>
                            <td>{{ Form::textarea('desc' . $program->id, $program->desc, array('placeholder' => 'program description', 'size' => '30x3', 'class' => 'form-control')) }} </td>
                            <td>{{ Form::text('url' . $program->id, $program->url, array('placeholder' => 'http://', 'class' => 'form-control')) }} </td>
                            <td>{{ Form::checkbox('bold' . $program->id, '1', $program->bold) }}</td>
                            <td>{{ Form::select('color' . $program->id, array('black' => 'Black', 'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple', 'orange' => 'Orange', 'pink' => 'Pink'),
                        $program->color, array('class' => 'form-control')) }} </td>
                            <td>
                                <select name="category{{ $program->id }}" class="form-control">
                                    @foreach($categories as $category)
                                        @if($program->category == $category->id)
                                            <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td class='priority'>{{ $program->positionnumber }}</td>
                            <td>{{ Form::submit('Save', array('name' => 'saveprogram','class' => 'btn btn-custom skinny')) }}</td>
                            {{ Form::close() }}
                            <td>
                                {{ Form::open(array('route' => array('admin.dlb.destroy', $program->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                                {{ Form::submit('Delete', array('name' => 'deleteprogram','class' => 'btn btn-custom skinny')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            <br>


    </div>

    <script>
        // reorder the category numbers.
        $( "#categoriestbody" ).sortable({
            opacity: 0.6,
            cursor: 'move',
            stop: function( event, ui ){
                $(this).find('tr').each(function(i){
                    var pn = i+1;
                    // update the text in the order column to show the order that the categories will appear to people.
                    $(this).find('td:nth-last-child(3)').text(pn);
                    var order = $("#categoriestbody").sortable("serialize");
                    $(this).find("input[type=hidden]:eq(2)").val(order);
                    //var v = $(this).find("input[type=hidden]:eq(2)").val();
                    //alert(v);
                });
            }
        });

        // reorder the program numbers.
        $( "#programstbody" ).sortable({
            opacity: 0.6,
            cursor: 'move',
            stop: function( event, ui ){
                $(this).find('tr').each(function(i){
                    var pn = i+1;
                    // update the text in the order column to show the order that the categories will appear to people.
                    $(this).find('td:nth-last-child(3)').text(pn);
                    var order = $("#programstbody").sortable("serialize");
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