@extends('layouts.main')

@section('heading')




@stop


@section('pagetitle')

    Your Banners

@stop


@section('content')

    <p id="textcount" style="position:absolute; left: 0px;"></p>
    <div id="container" style="float:left; margin-right:40px;margin-top:10px;"> </div>

<div class="canvasrow text-center" id="canvascontainer">
        <canvas id="bannercanvas" class="canvasclass" width="600" height="300">
        </canvas>
</div>

<br><br>

Banner Width: <input type="text" id="bannerwidth">

Banner Height: <input type="text" id="bannerheight">

<br><br>

Background Color: <select id="pickbgcolor">
    <option value="#ff0000">Red</option>
    <option value="#00ff00">Green</option>
    <option value="#0000ff">Blue</option>
</select>

Background Image: <select id="pickbgimage">
</select>

Border Width: <select id="pickborderwidth">
    @for($i = 0; $i <= 20; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
    @endfor
</select>
Border Color: <select id="pickbordercolor">
    <option value="#ff0000">Red</option>
    <option value="#00ff00">Green</option>
    <option value="#0000ff">Blue</option>
</select>
Border Style: <select id="pickborderstyle">
    <option value="none">none</option>
    <option value="solid">solid</option>
    <option value="dotted">dotted</option>
    <option value="dashed">dashed</option>
    <option value="double">double</option>
    <option value="groove">groove</option>
    <option value="ridge">ridge</option>
    <option value="inset">inset</option>
    <option value="outset">outset</option>
</select>

<br><br>

Text to Add: <input type="text" id="texttoadd" size="25">

{{--Text to Add: <div id="texttoadd" contenteditable="true">Write here</div>--}}

Text Font: <select id="picktextfont">
    <option value="Arial" style="font-family: Arial;">Arial</option>
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
Text Size: <select id="picktextsize">
    @for($i = 8; $i <= 200; $i+=2)
        <option value="{{ $i }}px">{{ $i }}px</option>
    @endfor
</select><br>
Text Color: <select id="picktextcolor">
    <option value="#000000">Black</option>
    <option value="#ffffff">White</option>
    <option value="#ff0000">Red</option>
    <option value="#00ff00">Green</option>
    <option value="#0000ff">Blue</option>
</select>

<button id="bold" class="unbold"><strong>B</strong></button>
<button id="italic"><em>I</em></button>
<button id="underline"><u>U</u></button>
<button id="textadd">ADD</button>
<button id="undo">UNDO</button>
<button id="clear">CLEAR ALL</button>

    <br><br>
    <input id="btn-Preview-Image" type="button" value="Preview" />
    <br><br>
    <div id="previewImage">
    </div>

<script>

    // for previewing final image - this smaller image should be pasted to the canvas too instead of full size canvas. We also need widthxheight choice for banners.
    var element = $("#textcount"); // global variable <- I'll use this one to get the smaller image from the textcount div for resizing.
    var getCanvas; // global variable
    // preview canvas image
    $("#btn-Preview-Image").on('click', function () {
        document.getElementById("previewImage").innerHTML = "";
        var datafrom = $("#canvascontainer").get(0);
        html2canvas(datafrom, {
            onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
            }
        });
    });

    var position = 20;
    var canvasnumber = 2;

    /*
    $(document).ready(function() {
        $("#spinner").bind("ajaxSend", function() {
            $(this).show();
        }).bind("ajaxStop", function() {
            $(this).hide();
        }).bind("ajaxError", function() {
            $(this).hide();
        });
    });
    // end ready function
    */

        // banner width and height //
        $('#bannerwidth').on('change', function() {

        });

        // background //
        $('#pickbgcolor').on('change', function() {
           $('#bannercanvas').css('background', this.value);
        });

        // border //
        $('#pickborderwidth').on('change', function() {
            $('#bannercanvas').css('border-width', this.value + 'px');
        });
        $('#pickbordercolor').on('change', function() {
            $('#bannercanvas').css('border-color', this.value);
        });
        $('#pickborderstyle').on('change', function() {
            $('#bannercanvas').css('border-style', this.value);
        });

        // text //
        $('#textadd').on('click', function() {
            var canvasID = "canvas" + canvasnumber;
            var node = document.createElement("canvas");
            document.getElementById("canvascontainer").appendChild(node);
            node.setAttribute("id", canvasID);
            node.setAttribute("class", "overlay");
            node.setAttribute("width", "600");
            node.setAttribute("height", "300");
            node.setAttribute("draggable", true);
            $('#' + canvasID).css("z-index", canvasnumber);
            //$('#' + canvasID).css("background-color", "pink"); // check to make sure the new node was created.

            var canvas = document.getElementById(canvasID);
            var context = canvas.getContext("2d");
            var textColor = document.getElementById("picktextcolor").value;
            var text = document.getElementById("texttoadd").value;
            var bold = "";
            var italic = "";
            if ($( "#texttoadd" ).hasClass( "bold" )) {
                bold = "bold";
            }
            if ($( "#texttoadd" ).hasClass( "italic" )) {
                italic = "Italic";
            }
            var x = canvas.width / 2 - 90;
            var y = canvas.height / 2;
            var fontSize = document.getElementById("picktextsize").value;
            var textFont = document.getElementById("picktextfont").value;
            var textAlign = 'left';
            context.fillStyle = textColor;
            context.font = italic + " " + bold + " " + fontSize + " " + textFont;
            //alert(context.font); test that the above line is ok
            context.fillText(text, x, y);
            if ($("#texttoadd").hasClass("underline")) {
                textUnderline(context, text, x, y, textColor, fontSize, textAlign);
            }
            $("p#textcount").text(text);


            position = position + 20;
            canvasnumber++;
        });

        // font choice
        $('#picktextfont').on('change', function() {
            $('#texttoadd').css('font-family', this.value);
            // update hidden p
            var value = $('#texttoadd').val();
            $("p#textcount").text(value);
            var fontid =  $('#picktextfont').val();
            $("p#textcount").css("font-family", fontid);
            var color =  $('#picktextcolor').val();
            $("p#textcount").css("color", color);
            var size =  $('#picktextsize').val();
            $("p#textcount").css("font-size", size);
        }).keyup();

        // font size
        $('#picktextsize').on('change', function() {
            //$('#texttoadd').css('font-size', this.value); // commented out so the input doesn't get huge...
            var value = $('#texttoadd').val();
            $("p#textcount").text(value);
            var fontid =  $('#picktextfont').val();
            $("p#textcount").css("font-family", fontid);
            var color =  $('#picktextcolor').val();
            $("p#textcount").css("color", color);
            var size =  $('#picktextsize').val();
            $("p#textcount").css("font-size", size);
        }).keyup();

        // font  color
        $('#picktextcolor').on('change', function() {
            $('#texttoadd').css('color', this.value);
            var value = $('#texttoadd').val();
            $("p#textcount").text(value);
            var fontid =  $('#picktextfont').val();
            $("p#textcount").css("font-family", fontid);
            var color =  $('#picktextcolor').val();
            $("p#textcount").css("color", color);
            var size =  $('#picktextsize').val();
            $("p#textcount").css("font-size", size);
        }).keyup();

        // bold
        $('#bold').click(function(){
            $('#texttoadd').toggleClass('bold');
            $("#textcount").toggleClass('bold');
            if($('#textcount').hasClass('bold')) {
                $('#textcount').css('font-weight', 'bold');
            } else {
                $('#textcount').css('font-weight', 'normal');
            }
        });

        // italic
        $('#italic').click(function(){
            $('#texttoadd').toggleClass('italic');
            $("#textcount").toggleClass('italic');
            if($('#textcount').hasClass('italic')) {
                $('#textcount').css('font-style', 'italic');
            } else {
                $('#textcount').css('font-style', 'normal');
            }
        });

        // underline
        $('#underline').click(function(){
            $('#texttoadd').toggleClass('underline');
            $("#textcount").toggleClass('underline');
            if($('#textcount').hasClass('underline')) {
                $('#textcount').css('text-decoration', 'underline');
            } else {
                $('#textcount').css('text-decoration', 'none');
            }
        });

        // typing in text input
        $("#texttoadd").keyup(function () {
            var value = $(this).val();
            $("p#textcount").text(value);
            var fontid =  $('#picktextfont').val();
            $("p#textcount").css("font-family", fontid);
            var color =  $('#picktextcolor').val();
            $("p#textcount").css("color", color);
            var size =  $('#picktextsize').val();
            $("p#textcount").css("font-size", size);
        }).keyup();

        // undo one at a time
        $('#undo').on('click', function() {
            if (canvascontainer.lastChild.id != 'bannercanvas') {
                canvascontainer.removeChild(canvascontainer.lastChild);
                $('#previewImage').innerHTML = '';
                $('#textcount').innerHTML = '';
            }
            position--;
            canvasnumber--;
        });

        // undo all
        $('#clear').on('click', function() {
            $('#previewImage').innerHTML = '';
            $('#textcount').innerHTML = '';
            while (canvascontainer.lastChild.id != 'bannercanvas') {
                canvascontainer.removeChild(canvascontainer.lastChild);
            }
            position = 20;
            canvasnumber = 2;
        });





    // simulate underlining text as html canvas does not support it.
    // Function: https://scriptstock.wordpress.com/2012/06/12/html5-canvas-text-underline-workaround/
    var textUnderline = function(context,text,x,y,color,textSize,align){

        var textWidth =context.measureText(text).width;
        var startX = 0;
        var startY = y+(parseInt(textSize)/15);
        var endX = 0;
        var endY = startY;
        var underlineHeight = parseInt(textSize)/15;

        if(underlineHeight < 1){
            underlineHeight = 1;
        }

        context.beginPath();
        if(align == "center"){
            startX = x - (textWidth/2);
            endX = x + (textWidth/2);
        }else if(align == "right"){
            startX = x-textWidth;
            endX = x;
        }else{
            startX = x;
            endX = x + textWidth;
        }

        context.strokeStyle = color;
        context.lineWidth = underlineHeight;
        context.moveTo(startX,startY);
        context.lineTo(endX,endY);context.strokeStyle = color;
        context.stroke();
    }



    /////


</script>


@stop


@section('footer')



@stop