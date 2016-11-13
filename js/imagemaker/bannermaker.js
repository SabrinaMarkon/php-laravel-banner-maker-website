// PHPSS-BannerMakerApp by Sabrina Markon 2016 phpsitescripts@outlook.com

$(function() {

    // BANNER WIDTH: // PROBLEM STILL - text added shows outside if banner is smaller.
    $('#bannerwidth').on('keyup mouseup', function() {
        var value = $(this).val();
        if ($.isNumeric(value) && Math.floor(value) == +value && (value > 0 && value < 1001 && value !== null)) {
            $('#bannerwidtherror').css({'visibility' : 'hidden', 'display' : 'none'});
            var canvascontainer = document.getElementById("canvascontainer");
            $(canvascontainer).css('width', value);
        } else {
            $('#bannerwidtherror').css({'visibility' : '', 'display' : 'block'});
        }
    }).keyup();

    // BANNER HEIGHT:
    $('#bannerheight').on('keyup mouseup', function() {
        var value = $(this).val();
        if ($.isNumeric(value) && Math.floor(value) == +value && (value > 0 && value < 1001 && value !== null)) {
            $('#bannerheighterror').css({'visibility' : 'hidden', 'display' : 'none'});
            var canvascontainer = document.getElementById("canvascontainer");
            $(canvascontainer).css('height', value);
        } else {
            $('#bannerheighterror').css({'visibility' : 'visible', 'display' : 'block'});
        }
    }).keyup();

    // BACKGROUND COLOR:
    $('#pickbgcolor').on('change', function() {
        if (this.value === 'transparent') {
            $('#pickbgcolor').css({ 'background' : 'transparent', 'color' : '' });
            $('#canvascontainer').css({ 'background' : 'transparent url("/images/canvasbg.gif")' });
        } else {
            $('#pickbgcolor').css({ 'background' : this.value, 'color' : idealTextColor(this.value) });
            $('#canvascontainer').css({ 'background' : this.value });
        }
    });

    // BACKGROUND PREVIEW:
    $('#pickbgimage').mouseenter(function(){
        var bgimagepreview = document.getElementById('pickbgimage').value;
        if (bgimagepreview !== 'none') {
            var imgstyle = "max-width: 100%; max-height: 100%; background: none; margin: auto;";
            $('#bgimagepreview').html('<img src="' + bgimagepreview + '" style="' + imgstyle + '">');
        } else {
            $('#bgimagepreview').css({ 'display' : 'block' });
        }
    });

    // BACKGROUND IMAGE:
    $('#pickbgimage').on('change', function() {
        if (this.value === 'none') {
            $('#canvascontainer').css({ 'background' : '' });
        } else {
            $('#canvascontainer').css({ 'background' : 'url("' + this.value + '")', 'background-size' : '100% 100%' });
        }
    });

    // BORDER COLOR:
    $('#pickbordercolor').on('change', function() {
        var pickborderwidth = document.getElementById('pickborderwidth').value;
        var pickborderstyle = document.getElementById('pickborderstyle').value;
        if (this.value === 'transparent') {
            $('#pickbordercolor').css({ 'background' : 'transparent', 'color' : '' });
        } else {
            $('#pickbordercolor').css({ 'background' : this.value, 'color' : idealTextColor(this.value) });
        }
    });

    // BORDER WIDTH:
    $('#pickborderwidth').on('keyup mouseup', function() { // works with both keyboard entry or the number field's up/down arrows.
        var value = $(this).val();
        if ($.isNumeric(value) && Math.floor(value) == +value && (value > -1 && value < 21 && value !== null)) {
            $('#borderwidtherror').css({'visibility' : 'hidden', 'display' : 'none'});
        } else {
            $('#borderwidtherror').css({'visibility' : 'visible', 'display' : 'block'});
        }
    }).keyup();

    // ADD BORDER:

    $('#borderadd').on('click', function() {
        var pickbordercolor = document.getElementById('pickbordercolor').value;
        var pickborderwidth = document.getElementById('pickborderwidth').value;
        var pickborderstyle = document.getElementById('pickborderstyle').value;
        if (pickbordercolor === 'transparent' || pickborderwidth < 1 || pickborderstyle === 'none') {
            $('#canvascontainer').css({ 'border' : '0 transparent' });
        } else {
            $('#canvascontainer').css( { 'border' : pickborderwidth + 'px ' + pickborderstyle + ' ' + pickbordercolor });
        }
    });

    // DELETE BORDER:
    $('#borderdelete').on('click', function() {
        $('#canvascontainer').css({ 'border' : '0 transparent' });
    });

    // FONT COLOR:
    $('#picktextcolor').on('change', function() {
        $('#picktextcolor').css({ 'background' : this.value, 'color' : idealTextColor(this.value) });
    });

    // FONT SIZE:
    $('#picktextsize').on('keyup mouseup', function() {
        var value = $(this).val();
        if ($.isNumeric(value) && Math.floor(value) == +value && (value > 0 && value < 301 && value !== null)) {
            $('#textsizeerror').css({'visibility' : 'hidden', 'display' : 'none'});
        } else {
            $('#textsizeerror').css({'visibility' : 'visible', 'display' : 'block'});
        }
    }).keyup();


    // ADD TEXT:
    $('#textadd').on('click', function() {
        var text = document.getElementById('texttoadd').value;
        var fontcolor = document.getElementById('picktextcolor').value;
        var fontfamily = document.getElementById('picktextfont').value;
        var fontsize = document.getElementById('picktextsize').value;
        var bold = document.getElementById('bold').checked;
        var italic = document.getElementById('italic').checked;
        var underline = document.getElementById('underline').checked;
        var textstyle = "color: " + fontcolor + "; font-family: " + fontfamily + "; font-size: " + fontsize + "px; background: none; border: 0px;";
        if (bold) { textstyle += " font-weight: bold;"; } else { textstyle += " font-weight: normal;"; }
        if (italic) { textstyle += " font-style: italic;"; } else { textstyle += " font-style: normal;"; }
        if (underline) { textstyle += " text-decoration: underline;"; } else { textstyle += " text-decoration: none;"; }

        var newid = $("#canvascontainer > div").length + 1;

        // RESIZABLE TEXT (commented out because between this and the images, there are too many resize handles and font size can be specified beforehand)
        // $('#canvascontainer').append($('<div id="' + newid + '"  class="ui-widget-content canvaslayer" style="' + textstyle + '">' + text + '</div>')
        //     .draggable({ containment : "#canvascontainer" })
        //     .resizable({
        //       containment: "#canvascontainer",
        //       handles: "nw, ne, sw, se",
        //       resize : function(event, ui) {
        //       // handle fontsize here
        //       //console.log(ui.size); // gives you the current size of the div
        //       var size = ui.size;
        //       // something like this change the values according to your requirements
        //       $(this).css("font-size", (size.width * size.height)/1000 + "px");
        //       }
        //   }));

        $('#canvascontainer').append($('<div id="' + newid + '"  class="ui-widget-content canvaslayer" style="' + textstyle + '">' + text + '</div>')
            .draggable({ containment : "#body" }));
    });


    // TEXT BOLD:
    $('#bold').click(function(){
        $('#texttoadd').toggleClass('bold');
        $("#textcount").toggleClass('bold');
        if($('#textcount').hasClass('bold')) {
            $('#textcount').css('font-weight', 'bold');
        } else {
            $('#textcount').css('font-weight', 'normal');
        }
    });

    // TEXT ITALIC:
    $('#italic').click(function(){
        $('#texttoadd').toggleClass('italic');
        $("#textcount").toggleClass('italic');
        if($('#textcount').hasClass('italic')) {
            $('#textcount').css('font-style', 'italic');
        } else {
            $('#textcount').css('font-style', 'normal');
        }
    });

    // IMAGE PREVIEW:
    $('#pickimage option').hover(function(){
        var imagepreview = document.getElementById('pickimage').value;
        if (imagepreview !== 'none') {
            var imgstyle = "max-width: 100%; max-height: 100%; background: none; margin: auto;";
            $('#imagepreview').html('<img src="' + imagepreview + '" style="' + imgstyle + '">');
        } else {
            $('#imagepreview').css({ 'display' : 'block' });
        }
    });

    // ADD IMAGE:
    $('#imageadd').on('click', function() {
        var pickimage = document.getElementById('pickimage').value;
        if (pickimage !== 'none') {
            var canvascontainer = document.getElementById("canvascontainer");
            var imgstyle = "max-width: 100%; max-height: 100%; background: none;";

            var newid = $("#canvascontainer > div").length + 1;

            $('#canvascontainer').append($('<div id="' + newid + '" class="canvaslayer picture"><img class="ui-widget-content" src="' + pickimage + '" style="' + imgstyle + '"></div>')
                .draggable({ containment : "body" })
                .resizable({
                    //containment : "#maineditpane",
                    handles: "nw, ne, sw, se",
                    aspectRatio: false
                })
            );
        }
    });

    // TOGGLE RESIZE HANDLES:
    $('#imagehandles').on('change', function() {
        if (document.getElementById('imagehandles').value === 'no') {
            $(".ui-resizable-handle").hide();
        } else {
            $(".ui-resizable-handle").show();
        }

    })

    // UNDO ONE BY ONE:
    $('#undo').on('click', function() {
        if ($('#canvascontainer').find('.canvaslayer').length) {
            canvascontainer.removeChild(canvascontainer.lastChild);
            $('#savediv').empty();
        }
    });

    // UNDO ALL:
    $('#clear').on('click', function() {
        document.getElementById('canvascontainer').innerHTML = '';
        $('#canvascontainer').css({ 'border' : '0 transparent', 'background' : '' });
        $('#savediv').empty();
    });

    // SAVE IMAGE:
    $("#save").click(function() {
        $('#savediv').empty();
        // is there a background image?
        var bg = '';
        if ($('#canvascontainer').css('background-image') !== 'none') {
            var sub = $('#canvascontainer').css('background-image');
            // is it the default background?
            if (sub.substr(sub.length - 14) === 'canvasbg.gif")') {
                bg = '';
            } else {
                bg = sub;
            }
        } else {
            bg = $('#canvascontainer').css('background-color');
        }
        $(".ui-resizable-handle").hide();
        html2canvas($("#canvascontainer"), {
            background: bg,
            proxy: 'https://cdn.hyperdev.com',
            logging: true,
            allowTaint: true,
            onrendered: function(canvas) {
                theCanvas = canvas;
                $('#savediv').append('<h3>Your Image:</h3>')
                $('#savediv').append(canvas);
                //Show the download button.
                $('#downloadbuttondiv').show();
                //Set hidden field's value to image data (base-64 string)
                $('#img_val').val(canvas.toDataURL("image/png"));
            }
        });
    });

    // DOWNLOAD IMAGE:
    $("#downloadbutton").on('click', function() {
        document.getElementById("downloadform").submit();
    });


    // SUPPORTING FUNCTIONS:

    // GET CONTRASTING TEXT COLOR FOR BACKGROUNDS:
    function idealTextColor(bgColor) {

        var nThreshold = 105;
        var components = getRGBComponents(bgColor);
        var bgDelta = (components.R * 0.299) + (components.G * 0.587) + (components.B * 0.114);

        return ((255 - bgDelta) < nThreshold) ? "#000000" : "#ffffff";
    }

    function getRGBComponents(color) {

        var r = color.substring(1, 3);
        var g = color.substring(3, 5);
        var b = color.substring(5, 7);

        return {
            R: parseInt(r, 16),
            G: parseInt(g, 16),
            B: parseInt(b, 16)
        };
    }

    // COLORS
    var colorNames = [
        "Black", "White", "Radical Red", "Wild Watermelon", "Outrageous Orange", "Atomic Tangerine", "Neon Carrot", "Sunglow",
        "Laser Lemon", "Unmellow Yellow", "Electric Lime", "Screamin' Green", "Magic Mint", "Blizzard Blue", "Shocking Pink",
        "Razzle Dazzle Rose", "Hot Magenta", "Purple Pizzazz", "Red", "Maroon", "Scarlet", "Brick Red", "English Vermilion",
        "Madder Lake", "Permanent Geranium Lake", "Maximum Red", "Indian Red", "Orange-Red", "Sunset Orange", "Bittersweet",
        "Dark Venetian Red", "Venetian Red", "Light Venetian Red", "Vivid Tangerine", "Middle Red", "Burnt Orange", "Red-Orange",
        "Orange", "Macaroni and Cheese", "Middle Yellow Red", "Mango Tango", "Yellow-Orange", "Maximum Yellow Red", "Banana Mania",
        "Maize", "Orange-Yellow", "Goldenrod", "Dandelion", "Yellow", "Green-Yellow", "Middle Yellow", "Olive Green", "Spring Green",
        "Maximum Yellow", "Canary", "Lemon Yellow", "Maximum Green Yellow", "Middle Green Yellow", "Inchworm", "Light Chrome Green",
        "Yellow-Green", "Maximum Green", "Asparagus", "Granny Smith Apple", "Fern", "Middle Green", "Green", "Medium Chrome Green",
        "Forest Green", "Sea Green", "Shamrock", "Mountain Meadow", "Jungle Green", "Caribbean Green", "Tropical Rain Forest",
        "Middle Blue Green", "Pine Green", "Maximum Blue Green", "Robin's Egg Blue", "Teal Blue", "Light Blue", "Aquamarine",
        "Turquoise Blue", "Outer Space", "Sky Blue", "Middle Blue", "Blue-Green", "Pacific Blue", "Cerulean", "Maximum Blue",
        "Blue (I)", "Cerulean Blue", "Cornflower", "Green-Blue", "Midnight Blue", "Navy Blue", "Denim", "Blue (III)",
        "Cadet Blue", "Periwinkle", "Blue (II)", "Wild Blue Yonder", "Indigo", "Manatee", "Cobalt Blue", "Celestial Blue",
        "Blue Bell", "Maximum Blue Purple", "Violet-Blue", "Blue-Violet", "Ultramarine Blue", "Middle Blue Purple", "Purple Heart",
        "Royal Purple", "Violet (II)", "Medium Violet", "Wisteria", "Lavender (I)", "Vivid Violet", "Maximum Purple",
        "Purple Mountains' Majesty", "Fuchsia", "Pink Flamingo", "Violet (I)", "Brilliant Rose", "Orchid", "Plum", "Medium Rose",
        "Thistle", "Mulberry", "Red-Violet", "Middle Purple", "Maximum Red Purple", "Jazzberry Jam", "Eggplant", "Magenta",
        "Cerise", "Wild Strawberry", "Lavender (II)", "Cotton Candy", "Carnation Pink", "Violet-Red", "Razzmatazz", "Pig Pink",
        "Carmine", "Blush", "Tickle Me Pink", "Mauvelous", "Salmon", "Middle Red Purple", "Mahogany", "Melon", "Pink Sherbert",
        "Burnt Sienna", "Brown", "Sepia", "Fuzzy Wuzzy", "Beaver", "Tumbleweed", "Raw Sienna", "Van Dyke Brown", "Tan",
        "Desert Sand", "Peach", "Burnt Umber", "Apricot", "Almond", "Raw Umber", "Shadow", "Raw Sienna (I)", "Timberwolf", "Gold (I)",
        "Gold (II)", "Silver", "Copper", "Antique Brass", "Charcoal Gray", "Gray", "Blue-Gray", "Sizzling Red",
        "Red Salsa", "Tart Orange", "Orange Soda", "Bright Yellow", "Yellow Sunshine", "Slimy Green", "Green Lizard", "Denim Blue",
        "Blue Jeans", "Plump Purple", "Purple Plum", "Sweet Brown", "Brown Sugar", "Eerie Black", "Black Shadows", "Fiery Rose",
        "Sizzling Sunrise", "Heat Wave", "Lemon Glacier", "Spring Frost", "Absolute Zero", "Winter Sky", "Frostbite" ];

    var colorHex = [
        "#000000", "#FFFFFF", "#FF355E", "#FD5B78", "#FF6037", "#FF9966", "#FF9933", "#FFCC33", "#FFFF66", "#FFFF66", "#CCFF00",
        "#66FF66", "#AAF0D1", "#50BFE6", "#FF6EFF", "#EE34D2", "#FF00CC", "#FF00CC", "#ED0A3F", "#C32148", "#FD0E35", "#C62D42",
        "#CC474B", "#CC3336", "#E12C2C", "#D92121", "#B94E48", "#FF5349", "#FE4C40", "#FE6F5E", "#B33B24", "#CC553D", "#E6735C", "#FF9980",
        "#E58E73", "#FF7F49", "#FF681F", "#FF8833", "#FFB97B", "#ECB176", "#E77200", "#FFAE42", "#F2BA49", "#FBE7B2", "#F2C649",
        "#F8D568", "#FCD667", "#FED85D", "#FBE870", "#F1E788", "#FFEB00", "#B5B35C", "#ECEBBD", "#FAFA37", "#FFFF99", "#FFFF9F",
        "#D9E650", "#ACBF60", "#AFE313", "#BEE64B", "#C5E17A", "#5E8C31", "#7BA05B", "#9DE093", "#63B76C", "#4D8C57", "#3AA655",
        "#6CA67C", "#5FA777", "#93DFB8", "#33CC99", "#1AB385", "#29AB87", "#00CC99", "#00755E", "#8DD9CC", "#01786F", "#30BFBF",
        "#00CCCC", "#008080", "#8FD8D8", "#95E0E8", "#6CDAE7", "#2D383A", "#76D7EA", "#7ED4E6", "#0095B7", "#009DC4", "#02A4D3",
        "#47ABCC", "#4997D0", "#339ACC", "#93CCEA", "#2887C8", "#00468C", "#0066CC", "#1560BD", "#0066FF", "#A9B2C3", "#C3CDE6",
        "#4570E6", "#7A89B8", "#4F69C6", "#8D90A1", "#8C90C8", "#7070CC", "#9999CC", "#ACACE6", "#766EC8", "#6456B7", "#3F26BF",
        "#8B72BE", "#652DC1", "#6B3FA0", "#8359A3", "#8F47B3", "#C9A0DC", "#BF8FCC", "#803790", "#733380", "#D6AEDD", "#C154C1",
        "#FC74FD", "#732E6C", "#E667CE", "#E29CD2", "#8E3179", "#D96CBE", "#EBB0D7", "#C8509B", "#BB3385", "#D982B5", "#A63A79",
        "#A50B5E", "#614051", "#F653A6", "#DA3287", "#FF3399", "#FBAED2", "#FFB7D5", "#FFA6C9", "#F7468A", "#E30B5C", "#FDD7E4",
        "#E62E6B", "#DB5079", "#FC80A5", "#F091A9", "#FF91A4", "#A55353", "#CA3435", "#FEBAAD", "#F7A38E", "#E97451", "#AF593E",
        "#9E5B40", "#87421F", "#926F5B", "#DEA681", "#D27D46", "#664228", "#D99A6C", "#EDC9AF", "#FFCBA4", "#805533", "#FDD5B1",
        "#EED9C4", "#665233", "#837050", "#E6BC5C", "#D9D6CF", "#92926E", "#E6BE8A", "#C9C0BB", "#DA8A67", "#C88A65",
        "#736A62", "#8B8680", "#C8C8CD", "#FF3855", "#FD3A4A", "#FB4D46", "#FA5B3D", "#FFAA1D", "#FFF700", "#299617", "#A7F432",
        "#2243B6", "#5DADEC", "#5946B2", "#9C51B6", "#A83731", "#AF6E4D", "#1B1B1B", "#BFAFB2", "#FF5470", "#FFDB00", "#FF7A00",
        "#FDFF00", "#87FF2A", "#0048BA", "#FF007C", "#E936A7" ];

    var colors = '';
    colorNames.forEach(function(color, id) {
        var hex = colorHex[id];
        var textcolor = idealTextColor(hex);
        colors += '<option value="' + hex + '" style="background-color: ' + hex + '; color: ' + textcolor + '">' + color + ': ' + hex + '</option>';
    });

    document.getElementById('pickbgcolor').innerHTML = '<option value="transparent" selected="selected">None</option>' + colors;
    document.getElementById('pickbordercolor').innerHTML = '<option value="transparent" selected="selected">None</option>' + colors;
    document.getElementById('picktextcolor').innerHTML = '<option disabled selected="selected">Select</option>' + colors;


});
