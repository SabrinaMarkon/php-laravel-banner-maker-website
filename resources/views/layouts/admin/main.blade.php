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
        <div id="sidebar" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <!-- sidebar content -->
                @include('includes.admin.sidemenu')
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 text-center">

            <div class="content">
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
