<!DOCTYPE html>

<html lang="en">

<head>
    @include('includes.head')
    @yield('heading')
</head>

<body>

<div class="container-fluid">

    <div id="main" class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">

            @include('includes.header')

            <div class="content">
                <div class="title">
                    @yield('pagetitle')
                </div>
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                @yield('heading')
                                @yield('content')

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                </div>
            </div>

        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
    </div>

    <footer class="row">
            @include('includes.footer')
            @yield('footer')
    </footer>

</div>
</body>
</html>