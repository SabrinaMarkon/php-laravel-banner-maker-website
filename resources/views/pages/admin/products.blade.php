@extends('layouts.admin.main')

@section('heading')

    <!-- tinyMCE -->
    <script language="javascript" type="text/javascript" src="{{ asset('../js/tinymce/tinymce.min.js') }}"></script>
    <script language="javascript" type="text/javascript">
        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            body_id: 'elm1=pagecontent',
            height: 400,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
    <!-- /tinyMCE -->

@stop


@section('pagetitle')

    Products For Sale

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

        {{-- SELECT PRODUCT TO EDIT FORM --}}
        @if (count($contents) > 0)
            {{ Form::open(array('url' => 'admin/products/show', 'method' => 'GET', 'class' => 'form-horizontal')) }}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('id', 'Edit Product: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-6">
                        <select name="id" class="form-control">
                            <option value="" disabled selected>Select product to edit</option>
                            @foreach($contents as $content)
                                @if (Session::has('product') && Session::get('product')->id == $content->id)
                                    <option value="{{ $content->id }}" selected>{{ $content->name }}</option>
                                @else
                                    <option value="{{ $content->id }}">{{ $content->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">{{ Form::submit('Edit', array('class' => 'btn btn-custom skinny')) }}</div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            {{ Form::close() }}
        @endif

        @if (Session::has('product'))
            {{-- EDIT PRODUCT FORM --}}
            {{ Form::open(array('route' => array('admin.products.update', Session::get('product')->id), 'method' => 'PATCH')) }}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('productname', 'Product Name: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::text('productname', Session::get('product')->name, array('placeholder' => 'product name', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('quantity', 'Quantity: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::selectRange('quantity', 1, 100, Session::get('product')->quantity, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('price', 'Price: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::input('number', 'price', Session::get('product')->price, array('class' => 'form-control', 'step' => '0.01', 'min' => '0.01')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('commission', 'Commission: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::input('number', 'commission', Session::get('product')->commission, array('class' => 'form-control', 'step' => '0.01', 'min' => '0.00')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10 text-left"><br>
                            {{ Form::label('description', 'Product Description: ') }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            {{ Form::textarea('description', Session::get('product')->description, ['size' => '65x30']) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        {{ Form::button('Return', array('class' => 'btn btn-custom', 'onclick' => "parent.location = 'products'")) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::submit('Save Product', array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::open(array('route' => array('admin.products.destroy', Session::get('product')->id), 'method' => 'DELETE')) }}
                        {{ Form::submit('Delete Product', array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>

        @else

            {{-- CREATE NEW PRODUCT FORM --}}
            {{ Form::open(array('route' => array('admin.products.store'), 'method' => 'POST')) }}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('productname', 'Product Name: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::text('productname', old('productname'), array('placeholder' => 'product name', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('quantity', 'Quantity: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::selectRange('quantity', 1, 100, old('quantity'), array('class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('quantity', 'Price: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::input('number', 'price', old('price'), array('placeholder' => '0.01', 'class' => 'form-control', 'step' => '0.01', 'min' => '0.01')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('commission', 'Commission: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::input('number', 'commission', old('commission'), array('placeholder' => '0.00', 'class' => 'form-control', 'step' => '0.01', 'min' => '0.00')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
                <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10 text-left"><br>
                        {{ Form::label('description', 'Product Description: ') }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        {{ Form::textarea('description', old('description'), ['size' => '65x30']) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        {{ Form::submit('Create Product', array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        @endif

    </div>

@stop


@section('footer')



@stop