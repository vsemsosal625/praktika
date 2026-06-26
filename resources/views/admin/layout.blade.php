@extends('layouts.app')

@section('content')
    <h1 class="page-title">Панель администратора</h1>
    <div class="admin-layout">
        @include('admin.partials.sidebar')
        <div><?php echo $__env->yieldContent('admin'); ?></div>
    </div>
@endsection
