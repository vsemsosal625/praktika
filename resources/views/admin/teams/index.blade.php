@extends('admin.layout')
@section('title', 'Команды')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Команды</h2>
        <a href="<?php echo e(route('admin.teams.create')); ?>" class="btn btn-primary">+ Добавить</a>
    </div>
    <table class="table">
        <thead><tr><th>Название</th><th>Вид спорта</th><th>Страна</th><th></th></tr></thead>
        <tbody>
        @forelse ($teams as $t)
            <tr>
                <td><?php echo e($t->name); ?></td>
                <td><?php echo e($t->sport->name ?? '—'); ?></td>
                <td><?php echo e($t->country); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.teams.edit', $t)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.teams.destroy', $t)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Уд.</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Пусто.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;"><?php echo $teams->links(); ?></div>
@endsection
