@extends('admin.layout')
@section('title', 'Пользователи')

@section('admin')
    <h2>Пользователи</h2>
    <table class="table">
        <thead><tr><th>Имя</th><th>Email</th><th>Роль</th><th>Статус</th><th>Регистрация</th><th></th></tr></thead>
        <tbody>
        @forelse ($users as $u)
            <tr>
                <td><?php echo e($u->name); ?></td>
                <td><?php echo e($u->email); ?></td>
                <td><?php echo e($u->role === 'admin' ? 'Администратор' : 'Пользователь'); ?></td>
                <td><?php echo e($u->is_blocked ? '🚫 Заблокирован' : '✅ Активен'); ?></td>
                <td><?php echo e($u->created_at->format('d.m.Y')); ?></td>
                <td>
                    @if ($u->id !== auth()->id())
                        <form action="<?php echo e(route('admin.users.toggleBlock', $u)); ?>" method="POST" style="display:inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm <?php echo e($u->is_blocked ? 'btn-light' : 'btn-danger'); ?>"><?php echo e($u->is_blocked ? 'Разблокировать' : 'Заблокировать'); ?></button>
                        </form>
                        <form action="<?php echo e(route('admin.users.toggleRole', $u)); ?>" method="POST" style="display:inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-light"><?php echo e($u->role === 'admin' ? 'Снять админа' : 'Сделать админом'); ?></button>
                        </form>
                    @else
                        <span class="meta">Это вы</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Пусто.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;"><?php echo $users->links(); ?></div>
@endsection
