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

    <div id="tiny">
        <form role="form" method="post" action="{{ url('admin/content') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <textarea  name="pagecontent" id="pagecontent" cols="65" rows="30">{{ old('pagecontent') }}</textarea>
                     </div>
                    <div class="col-sm-1"></div>
            </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-custom">Save</button>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
        </form>

@stop


@section('footer')



@stop