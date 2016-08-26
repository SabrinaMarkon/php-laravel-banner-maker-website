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

              Edit Pages

@stop


@section('content')

    <div class="form-page-medium">

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

        {{-- SELECT PAGE TO EDIT FORM --}}
        {{ Form::open(array('url' => 'admin/content/show', 'method' => 'GET', 'class' => 'form-horizontal')) }}
        <div class="form-group textfield">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">{{ Form::label('id', 'Edit Page: ', array('class' => 'control-label')) }}</div>
                <div class="col-sm-6">
                    <select name="id" class="form-control">
                        <option value="" disabled selected>Select page to edit</option>
                        @foreach($contents as $content)
                            @if (Session::has('page') && Session::get('page')->id == $content->id)
                                <option value="{{ $content->id }}" selected>{{ $content->name }}</option>
                            @else
                                <option value="{{ $content->id }}">{{ $content->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">{{ Form::submit('Edit Page', array('class' => 'btn btn-custom skinny')) }}</div>
                <div class="col-sm-1"></div>
             </div>
         </div>
         {{ Form::close() }}

        @if (Session::has('page'))
            {{-- EDIT PAGE FORM --}}
            {{ Form::open(array('route' => array('admin.content.update', Session::get('page')->id), 'method' => 'PATCH')) }}
            <div class="form-group textfield">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('pagename', 'Page Name: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::text('pagename', Session::get('page')->name, array('placeholder' => 'page name', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group textfield">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('', 'Page Tag/Slug: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8"><a href="{{ Request::root() . '/' . Session::get('page')->slug }}" target="_blank">{{ Request::root() . '/' . Session::get('page')->slug }}</a></div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        {{ Form::textarea('pagecontent', Session::get('page')->htmlcode, ['size' => '65x30']) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-2">
                        {{ Form::submit('Save Page', array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::open(array('route' => array('admin.content.destroy', Session::get('page')->id), 'method' => 'DELETE')) }}
                        {{ Form::submit('Delete Page', array('class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        @else
            {{-- CREATE NEW PAGE FORM --}}
            {{ Form::open(array('route' => array('admin.content.store'), 'method' => 'POST')) }}
            <div class="form-group textfield">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{ Form::label('pagename', 'Page Name: ', array('class' => 'control-label')) }}</div>
                    <div class="col-sm-8">
                        {{ Form::text('pagename', old('pagename'), array('placeholder' => 'page name', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        {{ Form::textarea('pagecontent', old('pagecontent'), ['size' => '65x30']) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        {{ Form::submit('Create Page', array('class' => 'btn btn-custom')) }}
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