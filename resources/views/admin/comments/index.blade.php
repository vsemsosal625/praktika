@extends('admin.layout')
@section('title', 'Модерация комментариев')

@section('admin')
    <h2>Модерация комментариев</h2>
    <table class="table">
        <thead><tr><th>Автор</th><th>Комментарий</th><th>Статья</th><th>Статус</th><th></th></tr></thead>
        <tbody>
        @forelse ($comments as $c)
            <tr>
                <td><?php echo e($c->user->name ?? '—'); ?></td>
                <td>
                    <form action="<?php echo e(route('admin.comments.update', $c)); ?>" method="POST">
                        @csrf @method('PUT')
                        <textarea name="body" class="form-control"><?php echo e($c->body); ?></textarea>
                        <button class="btn btn-sm btn-primary" type="submit">Сохранить</button>
                    </form>
                </td>
                <td>@if ($c->article)<a href="<?php echo e(route('articles.show', $c->article)); ?>"><?php echo e(Str::limit($c->article->title, 30)); ?></a>@endif</td>
                <td><?php echo e($c->is_hidden ? 'Скрыт' : 'Виден'); ?></td>
                <td>
                    <form action="<?php echo e(route('admin.comments.toggleHide', $c)); ?>" method="POST" style="display:inline">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm btn-light"><?php echo e($c->is_hidden ? 'Показать' : 'Скрыть'); ?></button>
                    </form>
                    <form action="<?php echo e(route('admin.comments.destroy', $c)); ?>" method="POST" style="display:inline" data-confirm="Удалить?">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Уд.</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Комментариев нет.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;"><?php echo $comments->links(); ?></div>
@endsection
