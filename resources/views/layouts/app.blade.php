
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Glamour Make')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-body">
    @php
        $hideSidebar = View::hasSection('hideSidebar');
    @endphp

    <div class="app-shell {{ $hideSidebar ? 'app-shell--login' : '' }}">

        @if (!$hideSidebar)
            <x-sidebar />
        @endif

        <div class="app-content">
            
            @if (!$hideSidebar)
                <x-header :title="trim($__env->yieldContent('title', 'Dashboard'))" />
            @endif

            <main class="page-content {{ $hideSidebar ? 'page-content--full' : '' }}">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>