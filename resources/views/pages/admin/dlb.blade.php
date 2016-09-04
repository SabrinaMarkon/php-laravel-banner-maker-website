@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Downline Builder

@stop


@section('content')

    <div class="form-page-medium">

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
                        {{ Form::submit('Create', array('class' => 'btn btn-custom skinny')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>

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
                    <tbody>

                    @foreach ($builders as $builder)
                        <tr id="ID_{{ $builder->id }}">
                            {{ Form::open(array('route' => array('admin.dlb.update', $builder->id), 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form' . $builder->id, 'name' =>  'form' . $builder->id)) }}
                            {{ Form::hidden('positionnumber' . $builder->id, $builders_id_order, ['id' => 'positionnumber' . $builder->id]) }}
                            <td><i class="fa fa-reorder"></i></td>
                            <td>{{ $builder->id }}</td>
                            <td>{{ Form::text('name' . $builder->id, $builder->name, array('placeholder' => 'category name', 'class' => 'form-control')) }} </td>
                            <td class='priority'>{{ $builder->positionnumber }}</td>
                            <td>{{ Form::submit('Save', array('class' => 'btn btn-custom skinny')) }}</td>
                            {{ Form::close() }}
                            <td>
                                {{ Form::open(array('route' => array('admin.dlb.destroy', $builder->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-custom skinny')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>



    {{--  PROGRAMS --}}



    </div>

    <script>
        // reorder the position numbers.
        $( "tbody" ).sortable({
            opacity: 0.6,
            cursor: 'move',
            stop: function( event, ui ){
                $(this).find('tr').each(function(i){
                    var pn = i+1;
                    // update the text in the order column to show the order that the categories will appear to people.
                    $(this).find('td:nth-last-child(3)').text(pn);
                    var order = $("tbody").sortable("serialize");
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