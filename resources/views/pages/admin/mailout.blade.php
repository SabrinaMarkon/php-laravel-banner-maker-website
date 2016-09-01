@extends('layouts.admin.main')

@section('heading')

    <!-- tinyMCE -->
    <script language="javascript" type="text/javascript" src="{{ asset('../js/tinymce/tinymce.min.js') }}"></script>
    <script language="javascript" type="text/javascript">
        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            body_id: 'elm1=message',
            height: 300,
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

    Email Members

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

            {{-- SELECT EMAIL TO SEND OR EDIT FORM --}}
            @if (count($contents) > 0)
                {{ Form::open(array('url' => 'admin/mailout/show', 'method' => 'GET', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">{{ Form::label('id', 'Send or Edit Email: ', array('class' => 'control-label')) }}</div>
                        <div class="col-sm-6">
                            <select name="id" class="form-control">
                                <option value="" disabled selected>Select email</option>
                                @foreach($contents as $content)
                                    @if (Session::has('mail') && Session::get('mail')->id == $content->id)
                                        <option value="{{ $content->id }}" selected>{{ $content->subject }}</option>
                                    @else
                                        <option value="{{ $content->id }}">{{ $content->subject }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">{{ Form::submit('Edit', array('class' => 'btn btn-custom skinny')) }}</div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                {{ Form::close() }}
            @endif

            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 text-left">
                    <p>Please use the personalization substitution below anywhere in your subject or message, typed EXACTLY as shown (cAsE sEnSiTiVe):</p><br />
                </div>
                <div class="col-sm-10 text-center">
                    <div class="row" style="padding-bottom:5px;"><div class="col-sm-2"></div><div class="col-sm-4"><u><strong>Type This:</strong></u></div><div class="col-sm-4"><u><strong>To Substitute:</strong></u></div><div class="col-sm-2"></div></div>
                    <div class="row"><div class="col-sm-2"></div><div class="col-sm-4">~USERID~</div><div class="col-sm-4">Member's UserID</div><div class="col-sm-2"></div></div>
                    <div class="row"><div class="col-sm-2"></div><div class="col-sm-4">~FULLNAME~</div><div class="col-sm-5">Member's First and Last Name</div><div class="col-sm-1"></div></div>
                    <div class="row"><div class="col-sm-2"></div><div class="col-sm-4">~FIRSTNAME~</div><div class="col-sm-4">Member's First Name</div><div class="col-sm-2"></div></div>
                    <div class="row"><div class="col-sm-2"></div><div class="col-sm-4">~LASTNAME~</div><div class="col-sm-4">Member's Last Name</div><div class="col-sm-2"></div></div>
                    <div class="row"><div class="col-sm-2"></div><div class="col-sm-4">~EMAIL~</div><div class="col-sm-4">Member's Email Address</div><div class="col-sm-2"></div></div>
                    <div class="row"><div class="col-sm-2"></div><div class="col-sm-4">~AFFILIATE_URL~</div><div class="col-sm-4">Member's Affiliate URL</div><div class="col-sm-2"></div></div>
                </div>
                <div class="col-sm-1"></div>
            </div><br /><br />

        @if (Session::has('mail'))
            {{-- EDIT OR SEND EMAIL FORM --}}
                {{ Form::open(array('route' => array('admin.mailout.update', Session::get('mail')->id), 'method' => 'PATCH')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            {{ Form::label('subject', 'Subject: ', array('class' => 'control-label')) }}
                        </div>
                        <div class="col-sm-8">
                            {{ Form::text('subject', Session::get('mail')->subject, array('placeholder' => 'subject', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            {{ Form::label('url', 'URL: ', array('class' => 'control-label')) }}
                        </div>
                        <div class="col-sm-8">
                            {{ Form::text('url', Session::get('mail')->url, array('placeholder' => 'url', 'class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10 text-left">
                            {{ Form::label('message', 'Message: ', array('class' => 'control-label')) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            {{ Form::textarea('message', Session::get('mail')->message, ['size' => '55x30']) }}
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            {{ Form::button('Return', array('class' => 'btn btn-custom', 'onclick' => "parent.location = 'mailout'")) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::submit('Save Email', array('name' => 'save', 'class' => 'btn btn-custom')) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::submit('Send Email', array('name' => 'send', 'class' => 'btn btn-custom')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::open(array('route' => array('admin.mailout.destroy', Session::get('mail')->id), 'method' => 'DELETE')) }}
                            {{ Form::submit('Delete Email', array('class' => 'btn btn-custom')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>

        @else
             {{-- CREATE NEW EMAIL FORM --}}
            {{ Form::open(array('route' => array('admin.mailout.store'), 'method' => 'POST')) }}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        {{ Form::label('subject', 'Subject: ', array('class' => 'control-label')) }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::text('subject', old('subject'), array('placeholder' => 'subject', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        {{ Form::label('url', 'URL: ', array('class' => 'control-label')) }}
                    </div>
                    <div class="col-sm-8">
                        {{ Form::text('url', old('url'), array('placeholder' => 'url', 'class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10 text-left">
                        {{ Form::label('message', 'Message: ', array('class' => 'control-label')) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        {{ Form::textarea('message', old('message'), ['size' => '55x30']) }}
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        {{ Form::submit('Save Email', array('name' => 'save', 'class' => 'btn btn-custom')) }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::submit('Send Email', array('name' => 'send', 'class' => 'btn btn-custom')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>

        @endif

    </div>

@stop


@section('footer')



@stop