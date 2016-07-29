<!DOCTYPE html>

<html lang="en">

<head>
    @include('includes.admin.head')
    @yield('header')
</head>

<body>

<!-- layout for admin login/forgot password pages without sidebar -->

<div class="container-fluid">

    <div  class="row">
        @include('includes.admin.header')
    </div>

    <div class="admincontent">
        <div class="title">
            @yield('pagetitle')
        </div>
        <div class="row">
            @yield('heading')
            @yield('content')
        </div>
    </div>

    <footer class="row">
        @include('includes.admin.footer')
        @yield('footer')
    </footer>

</div>
</body>
