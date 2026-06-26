@extends('admin.layout')
@section('title', 'Спортсмены')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Спортсмены</h2>
        <a href="<?php echo e(route('admin.athletes.create')); ?>" class="btn btn-primary">+ Добавить</a>
    </div>
    <table class="table">
        <thead><tr><th>Имя</th><th>Вид спорта</th><th>Команда</th><th>Страна</th><th></th></tr></thead>
        <tbody>
        @forelse ($athletes as $a)
            <tr>
                <td><?php echo e($a->name); ?></td>
                <td><?php echo e($a->sport->name ?? '—'); ?></td>
                <td><?php echo e($a->team->name ?? '—'); ?></td>
                <td><?php echo e($a->country); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.athletes.edit', $a)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.athletes.destroy', $a)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Уд.</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Пусто.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;"><?php echo $athletes->links(); ?></div>
@endsection
