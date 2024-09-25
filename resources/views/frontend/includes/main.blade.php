<!DOCTYPE html>
<html lang="en">
<head>
    @include("frontend.includes.header") <!-- This should be inside the <head> -->
</head>
<body>
    @include("frontend.includes.navbar")
    @yield('content')
    @include("frontend.includes.footer")
</body>
</html>
