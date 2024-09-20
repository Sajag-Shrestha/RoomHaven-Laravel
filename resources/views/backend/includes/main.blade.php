@include('backend.includes.header')
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="wrapper">
        @include('backend.includes.sidebar')
        <div class="main-panel">
            @include('backend.includes.navbar')
            @yield('content')
            @include('backend.includes.footer')
        </div>
        @include('backend.includes.setting')
    </div>
    @include('backend.includes.scripts')
