<!DOCTYPE html>

<html lang="en">

<head>
    @include('includes.head')
    @yield('header')
</head>

<body>

<div class="container-fluid">
    <div id="main" class="row">
        <div class="text-center">

            @include('includes.header')

            <div class="content">
                <div class="title">
                    @yield('pagetitle')
                </div>
                <div>
                      @yield('heading')
                      @yield('content')
                </div>

            </div>
        </div>
    </div>

    <footer class="row">
            @include('includes.footer')
            @yield('footer')
    </footer>

</div>
</body>
</html>