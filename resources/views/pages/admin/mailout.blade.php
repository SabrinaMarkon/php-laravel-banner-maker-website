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
        </div><br />

        <form class="form-horizontal" role="form">

            <div class="form-group">

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <label for="subject" class="control-label">Subject:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="{{ old('subject') }}">
                    </div>
                    <div class="col-sm-2"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <label for="url" class="control-label">URL:</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="url" id="url" placeholder="URL" value="{{ old('url') }}">
                    </div>
                    <div class="col-sm-2"></div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                         <label for="message" class="control-label">Message:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <textarea  name="message" id="message">{{ old('message') }}</textarea>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label class="checkbox inline">
                                <input type="checkbox" aria-label="Save This Message" id="save">Save This Message
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-custom">Send</button>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>

        </form>
    </div>

@stop


@section('footer')



@stop