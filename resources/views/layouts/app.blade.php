<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(View::yieldContent('title', 'Спортивные соревнования')); ?></title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('partials.header')

<main>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success"><?php echo e(session('status')); ?></div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li><?php echo e($error); ?></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</main>

@include('partials.footer')
</body>
</html>
