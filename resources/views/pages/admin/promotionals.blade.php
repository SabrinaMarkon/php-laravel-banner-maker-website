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

    Promotional Ads

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

            {{-- SELECT PROMOTIONAL AD TO EDIT FORM --}}
            @if (count($contents) > 0)
                {{ Form::open(array('url' => 'admin/promotionals/show', 'method' => 'GET', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('id', 'Edit Ad: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-6">
                            <select name="id" class="form-control">
                                <option value="" disabled selected>Select promotional ad to edit</option>
                                @foreach($contents as $content)
                                    @if (Session::has('promotional') && Session::get('promotional')->id == $content->id)
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

            @if (Session::has('promotional'))
                {{-- EDIT PROMOTIONAL AD FORM --}}
                {{ Form::open(array('route' => array('admin.promotionals.update', Session::get('promotional')->id), 'method' => 'PATCH')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('promotionalname', 'Ad Name: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-8">
                            {{ Form::text('promotionalname', Session::get('promotional')->name, array('placeholder' => 'promotional ad name', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('type', 'Ad Type: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-8">
                            {{ Form::select('type', ['email' => 'Email Ad', 'banner' => 'Banner Ad'], Session::get('promotional')->type, ['class' => 'form-control', 'onchange' => 'showfields()']) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div id="promotionalbannerfields" class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('p_image', 'Banner URL: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-7">
                            {{ Form::text('p_image', Session::get('promotional')->p_image, array('placeholder' => 'http://', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1">{{ Form::button('Preview', array('class' => 'btn-custom skinny', 'onclick' => 'showbannerpreview()')) }}</div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div id="promotionalemailfields" class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('p_subject', 'Email Subject: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-8">
                            {{ Form::text('p_subject', Session::get('promotional')->p_subject, array('placeholder' => 'subject', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10 text-left"><br>
                            {{ Form::label('p_message', 'Email Message: ') }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            {{ Form::textarea('p_message', Session::get('promotional')->p_message, ['size' => '65x30']) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div id="promotionalbannerpreview" class="form-group" style="display:none;">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div id="bannerimagepreview" class="col-sm-10"></div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-2">
                            {{ Form::button('Return', array('class' => 'btn btn-custom', 'onclick' => "parent.location = 'promotionals'")) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::submit('Save Ad', array('class' => 'btn btn-custom')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::open(array('route' => array('admin.promotionals.destroy', Session::get('promotional')->id), 'method' => 'DELETE')) }}
                            {{ Form::submit('Delete Ad', array('class' => 'btn btn-custom')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>

            @else

                {{-- CREATE NEW PROMOTIONAL AD FORM --}}
                {{ Form::open(array('route' => array('admin.promotionals.store'), 'method' => 'POST')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('promotionalname', 'Ad Name: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-8">
                            {{ Form::text('promotionalname', old('promotionalname'), array('placeholder' => 'promotional ad name', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('type', 'Create New Ad Type: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-8">
                            {{ Form::select('type', ['email' => 'Email Ad', 'banner' => 'Banner Ad'], old('type'), ['class' => 'form-control', 'onchange' => 'showfields()']) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div id="promotionalbannerfields" class="form-group" style="display:none;">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('p_image', 'Banner URL: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-7">
                            {{ Form::text('p_image', old('p_image'), array('placeholder' => 'http://', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1">{{ Form::button('Preview', array('class' => 'btn-custom skinny', 'onclick' => 'showbannerpreview()')) }}</div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div id="promotionalemailfields" class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">{{ Form::label('p_subject', 'Email Subject: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-8">
                            {{ Form::text('p_subject', old('p_subject'), array('placeholder' => 'subject', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10 text-left"><br>
                            {{ Form::label('p_message', 'Email Message: ') }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            {{ Form::textarea('p_message', old('p_message'), ['size' => '65x30']) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div id="promotionalbannerpreview" class="form-group" style="display:none;">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div id="bannerimagepreview" class="col-sm-10"></div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            {{ Form::submit('Create Ad', array('class' => 'btn btn-custom')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            @endif

    </div>

@stop


@section('footer')

    <script>
        // to show and hide fields depending on what kind of ad the user wants to make (banner or email)
        function showfields() {
            var typefield = $('#type').val();
            if (typefield == 'email') {
                $('#promotionalbannerfields').hide();
                $('#promotionalbannerpreview').hide();
                $('#promotionalemailfields').show();
            } else {
                $('#promotionalbannerfields').show();
                $('#promotionalbannerpreview').show();
                $('#promotionalemailfields').hide();
            }
        }
        function showbannerpreview() {
            var bannerurl = $('#p_image').val();
            $('#bannerimagepreview').html("<img src='" + bannerurl + "'class='border1px'>");
        }
        showfields();
        showbannerpreview();
    </script>

@stop