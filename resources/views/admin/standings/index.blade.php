@extends('admin.layout')
@section('title', 'Турнирные таблицы')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Турнирные таблицы</h2>
        <a href="<?php echo e(route('admin.standings.create')); ?>" class="btn btn-primary">+ Строка</a>
    </div>
    <table class="table">
        <thead><tr><th>Турнир</th><th>Команда</th><th>Поз.</th><th>Очки</th><th></th></tr></thead>
        <tbody>
        @forelse ($standings as $s)
            <tr>
                <td><?php echo e($s->tournament->name ?? '—'); ?></td>
                <td><?php echo e($s->team->name ?? '—'); ?></td>
                <td><?php echo e($s->position); ?></td>
                <td><?php echo e($s->points); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.standings.edit', $s)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.standings.destroy', $s)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
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
    <div style="margin-top:16px;"><?php echo $standings->links(); ?></div>
@endsection
