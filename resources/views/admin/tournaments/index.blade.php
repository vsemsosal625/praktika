@extends('admin.layout')
@section('title', 'Турниры')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Турниры</h2>
        <a href="<?php echo e(route('admin.tournaments.create')); ?>" class="btn btn-primary">+ Добавить</a>
    </div>
    <table class="table">
        <thead><tr><th>Название</th><th>Вид спорта</th><th>Страна</th><th>Сезон</th><th></th></tr></thead>
        <tbody>
        @forelse ($tournaments as $t)
            <tr>
                <td><?php echo e($t->name); ?></td>
                <td><?php echo e($t->sport->name ?? '—'); ?></td>
                <td><?php echo e($t->country); ?></td>
                <td><?php echo e($t->season); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.tournaments.edit', $t)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.tournaments.destroy', $t)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
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
    <div style="margin-top:16px;"><?php echo $tournaments->links(); ?></div>
@endsection
