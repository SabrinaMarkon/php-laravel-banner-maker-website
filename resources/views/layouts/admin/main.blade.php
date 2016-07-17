<!DOCTYPE html>

<html lang="en">

<head>
    @include('includes.admin.head')
    @yield('header')
</head>

<body>

<div class="container-fluid">

    <div  class="row">
            @include('includes.admin.header')
    </div>
    <div id="main" class="row">
        <div id="sidebar" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <!-- sidebar content -->
                @include('includes.admin.sidemenu')
        </div>
        <div id="rightside" class="col-xs-11 col-sm-11 col-md-11 col-lg-11 text-center">

            <div class="admincontent">
                <div class="title">
                    @yield('pagetitle')
                </div>
                <div class="row">
                        @yield('heading')
                        @yield('content')
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        @include('includes.admin.footer')
        @yield('footer')
    </footer>

</div>
</body>
