@extends('admin.layout')
@section('title', 'Новости — Админка')

@section('admin')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Управление новостями</h2>
        <a href="<?php echo e(route('admin.articles.create')); ?>" class="btn btn-primary">+ Новая статья</a>
    </div>
    <table class="table">
        <thead><tr><th>Заголовок</th><th>Тип</th><th>Статус</th><th>Дата</th><th></th></tr></thead>
        <tbody>
        @forelse ($articles as $a)
            <tr>
                <td><?php echo e($a->title); ?></td>
                <td><?php echo e($a->type); ?></td>
                <td><?php echo e($a->is_published ? 'Опубликована' : 'Черновик'); ?></td>
                <td><?php echo e($a->created_at->format('d.m.Y')); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.articles.edit', $a)); ?>" class="btn btn-sm btn-light">Изм.</a>
                    <form action="<?php echo e(route('admin.articles.destroy', $a)); ?>" method="POST" style="display:inline" data-confirm="Удалить статью?">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Уд.</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Статей нет.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;"><?php echo $articles->links(); ?></div>
@endsection
