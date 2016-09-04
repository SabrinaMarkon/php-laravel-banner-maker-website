@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    F.A.Q.s

@stop


@section('content')

    <div class="form-page-large">

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CREATE NEW FAQ FORM --}}
        <h2>Create New FAQ</h2>
        {{ Form::open(array('route' => array('admin.faqs.store'), 'method' => 'POST')) }}
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2">{{ Form::label('question', 'FAQ Question ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-6">
                    {{ Form::text('question', old('question'), array('placeholder' => 'FAQ question', 'class' => 'form-control')) }}
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2">{{ Form::label('answer', 'FAQ Answer: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-6">
                    {{ Form::textarea('answer', old('answer'), ['placeholder' => 'FAQ answer', 'size' => '75x5']) }}
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    {{ Form::submit('Create FAQ', array('class' => 'btn btn-custom')) }}
                    {{ Form::close() }}
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <br>

        {{-- ALL FAQs --}}
        <div class="table-responsive">
            <h2>Existing FAQ List</h2>
            <table class="table table-hover table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th>Reorder</th>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Order</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>


                @foreach ($faqs as $faq)
                    <tr id="ID_{{ $faq->id }}">
                        {{ Form::open(array('route' => array('admin.faqs.update', $faq->id), 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'form' . $faq->id, 'name' =>  'form' . $faq->id)) }}
                        {{ Form::hidden('positionnumber' . $faq->id, $faqs_id_order, ['id' => 'positionnumber' . $faq->id]) }}
                        <td><i class="fa fa-reorder"></i></td>
                        <td>{{ $faq->id }}</td>
                        <td>{{ Form::text('question' . $faq->id, $faq->question, array('placeholder' => 'FAQ question', 'class' => 'form-control')) }} </td>
                        <td>{{ Form::textarea('answer' . $faq->id, $faq->answer, ['placeholder' => 'FAQ answer', 'size' => '55x3']) }} </td>
                        <td class='priority'>{{ $faq->positionnumber }}</td>
                        <td>{{ Form::submit('Save', array('class' => 'btn btn-custom skinny')) }}</td>
                        {{ Form::close() }}
                        <td>
                            {{ Form::open(array('route' => array('admin.faqs.destroy', $faq->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-custom skinny')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>

    </div>

    <script>
        // reorder the position numbers.
        $( "tbody" ).sortable({
            opacity: 0.6,
            cursor: 'move',
            stop: function( event, ui ){
                $(this).find('tr').each(function(i){
                    var pn = i+1;
                    // update the text in the order column to show the order that the faqs will appear to people.
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