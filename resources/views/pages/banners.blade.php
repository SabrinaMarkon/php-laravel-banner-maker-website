@extends('layouts.main')

@section('heading')




@stop


@section('pagetitle')

    <script type="text/javascript">
        $.blockUI({ message: '<div id="preloader" style="font-size: 2em; font-family: Luckiest Guy, cursive;  color: #FFC125; padding: 30px;"><img src="/images/loading.gif" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loading Banner Library . . !</div>' });
    </script>

    Your Banners

@stop


@section('content')

    <div class="preloaddiv">{!!  $preloadimages !!} </div>

    @if (Session::has('message'))
        <div class="alert alert-info">{!! Session::get('message') !!}</div>
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

    <main>
        <div class="container-fluid">
            <div class="row no-gutter">
                <div id="lefteditpane" class="col-sm-4">
                    <div style="height: 10px;"></div>
                    <div class="controlbuttons text-center">
                        <button id="new" class="btn btn-yellow">NEW</button>
                        <button id="preview" class="btn btn-yellow">PREVIEW</button>
                        <div style="height: 5px;"></div>
                        <button id="undo" class="btn btn-yellow">UNDO</button>
                        <button id="clear" class="btn btn-yellow">CLEAR ALL</button>
                    </div>
                    <div style="height: 10px;"></div>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1">
                                        Dimensions</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Banner Width: <input type="number" id="bannerwidth" value="1000" class="editorinput"><span id="bannerwidtherror">
                    <span class="glyphicon glyphicon-exclamation-sign has-error" aria-hidden="true"></span><span class="has-error">Please enter an integer between 1 and 1000</span></span>
                                    <div style="height: 10px;"></div>
                                    Banner Height: <input type="number" id="bannerheight" value="300" class="editorinput"><span id="bannerheighterror">
                    <span class="glyphicon glyphicon-exclamation-sign has-error" aria-hidden="true"></span><span class="has-error">Please enter an integer between 1 and 1000</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse2">
                                        Background</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Background Color: <select id="pickbgcolor" class="editorinput"></select>
                                    <div style="height: 10px;"></div>
                                    Select Category:<select id="pickbgimagefolder" class="editorinput">
                                        <option value="none">None</option>
                                        {!! $foldertree !!}
                                    </select>
                                    <div style="height: 10px;"></div>
                                    Select Image:
                                    <div style="height: 5px;"></div>
                                    <div id="pickbgimage" class="editorinput">
                                    </div>
                                    <div style="height: 10px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse3">
                                        Border</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Border Color: <select id="pickbordercolor" class="editorinput"></select>
                                    <div style="height: 10px;"></div>
                                    Border Width: <input type="number" id="pickborderwidth" value="14" class="editorinput"><span id="borderwidtherror">
                    <span class="glyphicon glyphicon-exclamation-sign has-error" aria-hidden="true"></span><span class="has-error">Please enter an integer between 0 and 20</span></span>
                                    <input type="hidden" id="pickborderstyle" value="solid">
                                    {{-- uncomment below instead of the above once html2canvas has support for border styles other than solid. --}}
                                    {{--<div style="height: 10px;"></div>--}}
                                    {{--Border Style: <select id="pickborderstyle" class="editorinput">--}}
                                        {{--<option value="none" selected="selected">None</option>--}}
                                        {{--<option value="solid">solid</option>--}}
                                        {{--<option value="dotted">dotted</option>--}}
                                        {{--<option value="dashed">dashed</option>--}}
                                        {{--<option value="double">double</option>--}}
                                        {{--<option value="groove">groove</option>--}}
                                        {{--<option value="ridge">ridge</option>--}}
                                        {{--<option value="inset">inset</option>--}}
                                        {{--<option value="outset">outset</option>--}}
                                    {{--</select>--}}
                                    <div style="height: 10px;"></div>
                                    <button id="borderadd" class="btn btn-yellow">ADD BORDER</button>&nbsp;<button id="borderdelete" class="btn btn-yellow">CLEAR</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse4">
                                        Add Text</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Text to Add: <input type="text" id="texttoadd" size="25" class="editorinput">
                                    <div style="height: 10px;"></div>
                                    Font Color: <select id="picktextcolor" class="editorinput"></select>
                                    <div style="height: 10px;"></div>
                                    Font: <select id="picktextfont" class="editorinput">
                                        <option value="Arial" style="font-family: Arial;" selected="selected">Arial</option>
                                        <option value="Arial Black" style="font-family: Arial Black;">Arial Black</option>
                                        <option value="Arial Narrow" style="font-family: Arial Narrow;">Arial Narrow</option>
                                        <option value="Bebas Neue" style="font-family: Bebas Neue;">Bebas Neue</option>
                                        <option value="Cabin" style="font-family: Cabin;">Cabin</option>
                                        <option value="Century Gothic" style="font-family: Century Gothic;">Century Gothic</option>
                                        <option value="Copperplate Gothic Light" style="font-family: Copperplate Gothic Light;">Copperplate / Copperplate Gothic Light</option>
                                        <option value="Corbel" style="font-family: Corbel;">Corbel</option>
                                        <option value="Courier New" style="font-family: Courier New;">Courier New</option>
                                        <option value="Franchise" style="font-family: Franchise;">Franchise</option>
                                        <option value="Georgia" style="font-family: Georgia;">Georgia</option>
                                        <option value="Gill Sans" style="font-family: Gill Sans;">Gill Sans / Gill Sans MT</option>
                                        <option value="Helvetica" style="font-family: Helvetica;">Helvetica</option>
                                        <option value="Impact" style="font-family: Impact;">Impact</option>
                                        <option value="League Gothic" style="font-family: League Gothic;">League Gothic</option>
                                        <option value="Lobster" style="font-family: Lobster;">Lobster</option>
                                        <option value="Lucida Console" style="font-family: Lucida Console;">Lucida Console</option>
                                        <option value="Lucida Sans Unicode" style="font-family: Lucida Sans Unicode;">Lucida Sans Unicode</option>
                                        <option value="Luckiest Guy" style="font-family: Luckiest Guy;">Luckiest Guy</option>
                                        <option value="Museo Slab" style="font-family: Museo Slab;">Museo Slab</option>
                                        <option value="Myriad Pro" style="font-family: Myriad Pro;">Myriad Pro</option>
                                        <option value="Palatino Italic" style="font-family: Palatino Italic;">Palatino Italic</option>
                                        <option value="Palatino Linotype" style="font-family: Palatino Linotype;">Palatino Linotype</option>
                                        <option value="PT Serif" style="font-family: PT Serif;">PT Serif</option>
                                        <option value="Roboto" style="font-family: Roboto;">Roboto</option>
                                        <option value="Tahoma" style="font-family: Tahoma;">Tahoma</option>
                                        <option value="Tangerine" style="font-family: Tangerine;">Tangerine</option>
                                        <option value="Times New Roman" style="font-family: Times New Roman;">Times New Roman</option>
                                        <option value="Trebuchet MS" style="font-family: Trebuchet MS;">Trebuchet MS</option>
                                        <option value="Ubuntu" style="font-family: Ubuntu;">Ubuntu</option>
                                        <option value="Verdana" style="font-family: Verdana;">Verdana</option>
                                    </select>
                                    <div style="height: 10px;"></div>
                                    Font Size: <input type="number" id="picktextsize" value="40" class="editorinput"><span id="textsizeerror">
                    <span class="glyphicon glyphicon-exclamation-sign has-error" aria-hidden="true"></span><span class="has-error">Please enter an integer between 1 and 300</span></span>
                                    <div style="height: 10px;"></div>
                                    <div class="col-sm-12">
                                        <div class="checkbox">
                                            <label><input id="bold" type="checkbox" class="editorinput"><strong>Bold</strong></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input id="italic" type="checkbox" class="editorinput"><em>Italic</em></label>
                                        </div>
                                        <div class="checkbox checkbox-last">
                                            <label><input id="underline" type="checkbox" class="editorinput"><u>Underline</u></label>
                                        </div>
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <button id="textadd" class="btn btn-yellow">ADD TEXT</button>
                                </div>
                            </div>

                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse5">
                                        Images</a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Select Category:<select id="pickimagefolder" class="editorinput">
                                        <option value="none">None</option>
                                        {!! $foldertree !!}
                                        </select>
                                    <div style="height: 10px;"></div>
                                    Select Image:
                                    <div style="height: 5px;"></div>
                                    <div id="pickimage" class="editorinput">
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <button id="imageadd" class="btn btn-yellow">ADD IMAGE</button>
                                    <div style="height: 15px;"></div>
                                    Show Resize Handles: <select id="imagehandles" class="editorinput">
                                        <option value="yes">YES</option>
                                        <option value="no">NO</option>
                                    </select>

                                    <!--
                                    <div style="height: 10px;"></div>
                                    <label class="btn btn-default btn-file">
                                    Upload Image: <input type="file" style="display: none;">
                                    </label> UPLOAD FUNCTIONALITY AFTER -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="maineditpane" class="col-sm-8">

                    @if(count($savedimages) > 0)
                    <div id="savedimagesdiv">
                        <div class="panel-group" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapsesaved">
                                            Your Saved Banners</a>
                                    </h4>
                                </div>
                                <div id="collapsesaved" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul id="savedimageslist" class="editorinput list-unstyled">
                                            @foreach($savedimages as $savedimage)
                                                <li id="banner-{{ $savedimage->id }}">
                                                    <div><a  href="{{ $domain }}/mybanners/{{ $savedimage->filename }}" target="_blank">{{ $domain }}/mybanners/{{ $savedimage->filename }}</a></div>
                                                    <div style="height: 10px;"></div>
                                                    <div>
                                                        @if($savedimage->width > 300)
                                                            <img src="/mybanners/{{ $savedimage->filename }}" width="300">
                                                        @elseif($savedimage->height > 300)
                                                            <img src="/mybanners/{{ $savedimage->filename }}" height="300">
                                                        @else
                                                            <img src="/mybanners/{{ $savedimage->filename }}">
                                                        @endif
                                                    </div>
                                                    <div style="height: 10px;"></div>
                                                    <div class="row">
                                                        <div class="col-sm-4"></div>
                                                        <div class="col-sm-1 text-center">
                                                        {!!  Form::open(array('route' => array('banners.show', $savedimage->id), 'method' => 'GET', 'class' => 'form-horizontal')) !!}
                                                        {!!  Form::hidden('id', $savedimage->id) !!}
                                                        {!! Form::button('EDIT', array('id' => 'edit-' .  $savedimage->id, 'class' => 'btn btn-yellow')) !!}
                                                        {!! Form::close() !!}
                                                        </div>
                                                        <div class="col-sm-2 text-center">
                                                            <a  href="/mybanners/{{ $savedimage->filename }}" download="mybanner.png" class="btn btn-yellow">DOWNLOAD</a>
                                                        </div>
                                                        <div class="col-sm-1 text-center">
                                                        {!!  Form::open(array('route' => array('banners.destroy', $savedimage->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) !!}
                                                        {!!  Form::hidden('id', $savedimage->id) !!}
                                                        {!! Form::button('DELETE', array('id' => 'delete-' .  $savedimage->id, 'class' => 'btn btn-yellow')) !!}
                                                        {!! Form::close() !!}
                                                        </div>
                                                        <div class="col-sm-4"></div>
                                                    </div>
                                                    <hr>
                                                </li>
                                            @endforeach
                                        </ul>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div id="canvascontainer">

                    </div>
                    <div id="savediv">

                    </div>
                    <div id="savebuttondiv">
                        <form method="post" enctype="multipart/form-data" action="{{ url('/banners/getbanner') }}" id="saveform">
                            {{ csrf_field() }}
                            <input type="hidden" name="editingexistingimageid" id="editingexistingimageid" value="">
                            <input type="hidden" name="img_val" id="img_val" value="">
                            <input type="hidden" name="img_obj" id="img_obj" value="">
                            <input type="hidden" name="htmlcode" id="htmlcode" value="">
                            <button id="savebutton" class="btn btn-yellow">SAVE BANNER</button>
                        </form>
                    </div>
                    <div style="height: 20px;"></div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function(){
            $('.sadie').css("background-image", "url('/images/SadiePeace.png')");
        });
    </script>

@stop


@section('footer')

    <script src="/js/imagemaker/bannermaker.js"></script>
    <script type="text/javascript">
       $.unblockUI();
    </script>

@stop