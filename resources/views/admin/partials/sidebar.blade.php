<aside class="admin-sidebar">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">📊 Дашборд</a>
    <a href="<?php echo e(route('admin.articles.index')); ?>" class="<?php echo e(request()->routeIs('admin.articles.*') ? 'active' : ''); ?>">📰 Новости</a>
    <a href="<?php echo e(route('admin.sports.index')); ?>" class="<?php echo e(request()->routeIs('admin.sports.*') ? 'active' : ''); ?>">⚽ Виды спорта</a>
    <a href="<?php echo e(route('admin.tournaments.index')); ?>" class="<?php echo e(request()->routeIs('admin.tournaments.*') ? 'active' : ''); ?>">🏆 Турниры</a>
    <a href="<?php echo e(route('admin.teams.index')); ?>" class="<?php echo e(request()->routeIs('admin.teams.*') ? 'active' : ''); ?>">👥 Команды</a>
    <a href="<?php echo e(route('admin.athletes.index')); ?>" class="<?php echo e(request()->routeIs('admin.athletes.*') ? 'active' : ''); ?>">🏃 Спортсмены</a>
    <a href="<?php echo e(route('admin.matches.index')); ?>" class="<?php echo e(request()->routeIs('admin.matches.*') ? 'active' : ''); ?>">📅 Матчи</a>
    <a href="<?php echo e(route('admin.standings.index')); ?>" class="<?php echo e(request()->routeIs('admin.standings.*') ? 'active' : ''); ?>">📈 Турнирные таблицы</a>
    <a href="<?php echo e(route('admin.comments.index')); ?>" class="<?php echo e(request()->routeIs('admin.comments.*') ? 'active' : ''); ?>">💬 Комментарии</a>
    <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">🔑 Пользователи</a>
    <hr>
    <a href="<?php echo e(route('home')); ?>">← На сайт</a>
</aside>
