<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main_navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Sadie's Banner Creator</a>
        </div>
        <div class="navbar-collapse collapse text-center" id="main_navbar">
            <ul class="nav navbar-nav">
                <li><a href="/{{ $referid }}"><i class="fa fa-home"></i>home</a></li>
                <li><a href="/banners">banners</a></li>
                <li><a href="/about/{{ $referid }}">about</a></li>
                <!--<li><a href="/dlb">dlb</a></li>-->
                <li><a href="/products">products</a></li>
                <li><a href="/license">license</a></li>
                <li><a href="/terms/{{ $referid }}">terms</a></li>
                <!--<li><a href="/privacy/{{ $referid }}">privacy</a></li>-->
                <li><a href="/faqs/{{ $referid }}">faqs</a></li>
                <li><a href="/support/{{ $referid }}">support</a></li>
                <li><a href="/account">account</a></li>
                <!--<li><a href="/promote">promote</a></li>-->
                <li><a href="/join/{{ $referid }}">join</a></li>
                <li><a href="/login/{{ $referid }}">login</a></li>
                <!--<li><a href="/logout">logout</a></li>-->
            </ul>
        </div> <!-- navbar-collapse -->
    </div>
</nav>
