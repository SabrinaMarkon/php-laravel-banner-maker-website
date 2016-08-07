@extends('layouts.main')

@section('heading')




@stop


@section('pagetitle')

    Your Banners

@stop


@section('content')

<canvas id="bannercanvas" width="600" height="300"></canvas>

<br><br>

 Background Color: <select id="pickbgcolor">
     <option value="#ff0000">Red</option>
     <option value="#00ff00">Green</option>
     <option value="#0000ff">Blue</option>
 </select>

Background Image: <select id="pickbgimage">
</select>

<br><br>

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

Text to Add: <input type="text" id="texttoadd">

{{--Text to Add: <div id="texttoadd" contenteditable="true">Write here</div>--}}

Text Size: <select id="picktextsize">
    @for($i = 8; $i <= 200; $i+=2)
        <option value="{{ $i }}">{{ $i }}</option>
    @endfor
</select>
Text Color: <select id="picktextcolor">
    <option value="#000000">Black</option>
    <option value="#ffffff">White</option>
</select>

<button id="bold"><strong>B</strong></button>
<button id="italic"><em>I</em></button>
<button id="underline"><u>U</u></button>

<button id="textadd">ADD</button>

<script>
    $(document).ready(function() {
        // background
        $('#pickbgcolor').on('change', function() {
           $('#bannercanvas').css('background', this.value);
        });
        // border
        $('#pickborderwidth').on('change', function() {
            $('#bannercanvas').css('border-width', this.value + 'px');
        });
        $('#pickbordercolor').on('change', function() {
            $('#bannercanvas').css('border-color', this.value);
        });
        $('#pickborderstyle').on('change', function() {
            $('#bannercanvas').css('border-style', this.value);
        });


        // text
        $('#textadd').on('click', function() {
            var canvas = document.getElementById("bannercanvas");
            var context = canvas.getContext("2d");
            context.fillStyle = "blue";
            context.font = "bold 16px Arial";
            context.fillText('', 25, 25);
            context.fillText(document.getElementById("texttoadd").value, 25, 25);
        });

        $('#picktextsize').on('change', function() {
            $('#texttoadd').css('font-size', this.value);
        });
        $('#picktextcolor').on('change', function() {
            $('#texttoadd').css('color', this.value);
        });
        $('#bold').on('click', function() {
            $('#texttoadd').css('font-weight', this.value);
        });

    });
</script>

@stop


@section('footer')



@stop