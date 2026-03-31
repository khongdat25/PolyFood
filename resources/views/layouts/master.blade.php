<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PolyFood - @yield('title')</title>
    @vite(['resources/css/index.css', 'resources/css/' . trim($__env->yieldContent('page')) . '.css'])
    
</head>
<body>

    @include('layouts.header')
 
     @yield('content')
    @include('layouts.footer')


</body>
</html>