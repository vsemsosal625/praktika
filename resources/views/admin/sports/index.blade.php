@extends('admin.layout')
@section('title', 'Виды спорта')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Виды спорта</h2>
        <a href="<?php echo e(route('admin.sports.create')); ?>" class="btn btn-primary">+ Добавить</a>
    </div>
    <table class="table">
        <thead><tr><th>Название</th><th>Команд</th><th>Спортсменов</th><th></th></tr></thead>
        <tbody>
        @forelse ($sports as $s)
            <tr>
                <td><?php echo e($s->icon); ?> <?php echo e($s->name); ?></td>
                <td><?php echo e($s->teams_count); ?></td>
                <td><?php echo e($s->athletes_count); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.sports.edit', $s)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.sports.destroy', $s)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
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
@endsection
