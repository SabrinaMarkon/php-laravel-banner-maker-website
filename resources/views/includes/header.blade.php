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
            @if (Session::has('user'))
                <ul class="nav navbar-nav">
                    @if (Session::get('user')->admin == 1)
                        <li><a href="/admin/main" target="_blank"><i class="fa fa-home"></i>admin</a></li>
                    @else
                        <li><a href="/"><i class="fa fa-home"></i>home</a></li>
                    @endif
                    <li><a href="/account">account</a></li>
                    <li><a href="/banners">banners</a></li>
                    <li><a href="/profile">profile</a></li>
                    <li><a href="/promote">promote</a></li>
                    <li><a href="/maildownline">downline mailer</a></li>
                    <li><a href="/dlb">dlb</a></li>
                    <li><a href="/products">products</a></li>
                    <li><a href="/license">license</a></li>
                    <li><a href="/support/">support</a></li>
                    <li><a href="/logout">logout</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav">
                    <li><a href="/"><i class="fa fa-home"></i>home</a></li>
                    <li><a href="/products">products</a></li>
                    <li><a href="/about/">about</a></li>
                    <li><a href="/terms/">terms</a></li>
                    <li><a href="/privacy/">privacy</a></li>
                    <li><a href="/faqs/">faqs</a></li>
                    <li><a href="/support/">support</a></li>
                    <li><a href="/join/">join</a></li>
                    <li><a href="/login/">login</a></li>
                </ul>
            @endif
        </div> <!-- navbar-collapse -->
    </div>
</nav>
