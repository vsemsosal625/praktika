<header class="site-header">
    <div class="container">
        <nav class="navbar">
            <a href="<?php echo e(route('home')); ?>" class="brand">🏆 Спортивные соревнования</a>
            <div class="nav-links">
                <a href="<?php echo e(route('articles.index')); ?>">Новости</a>
                <a href="<?php echo e(route('tournaments.index')); ?>">Турниры</a>
                <a href="<?php echo e(route('teams.index')); ?>">Команды</a>
                <a href="<?php echo e(route('athletes.index')); ?>">Спортсмены</a>
            </div>
            <form action="<?php echo e(route('search')); ?>" method="GET" class="search-form">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Поиск...">
                <button class="btn btn-accent btn-sm" type="submit">Найти</button>
            </form>
            <div class="nav-links">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="<?php echo e(route('admin.dashboard')); ?>">Админка</a>
                    @endif
                    <a href="<?php echo e(route('profile.edit')); ?>"><?php echo e(auth()->user()->name); ?></a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        @csrf
                        <button class="btn btn-light btn-sm" type="submit">Выйти</button>
                    </form>
                @else
                    <a href="<?php echo e(route('login')); ?>">Вход</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-accent btn-sm">Регистрация</a>
                @endauth
            </div>
        </nav>
    </div>
</header>
