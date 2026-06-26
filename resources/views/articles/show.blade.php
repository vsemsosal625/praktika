@extends('layouts.app')
@section('title', $article->title)

@section('content')
    <article>
        <div class="meta">
            @if ($article->sport)<span class="badge badge-accent"><?php echo e($article->sport->name); ?></span>@endif
            <span><?php echo e(optional($article->published_at)->format('d.m.Y H:i')); ?></span>
        </div>
        <h1 class="page-title"><?php echo e($article->title); ?></h1>
        <p class="meta">Автор: <?php echo e($article->author->name ?? '—'); ?> &middot; <?php echo e($article->views); ?> просмотров</p>
        @if ($article->image)<img src="<?php echo e($article->image); ?>" class="card-img" style="height:360px; border-radius:12px;" alt="">@endif
        <div style="margin-top:18px; white-space:pre-line; font-size:16px;"><?php echo e($article->body); ?></div>
    </article>

    @if ($related->isNotEmpty())
        <h2 class="section-title">Похожие материалы</h2>
        <div class="grid grid-3">
            @foreach ($related as $article)
                @include('partials.article-card', ['article' => $article])
            @endforeach
        </div>
    @endif

    <h2 class="section-title">Комментарии (<?php echo e($article->comments->count()); ?>)</h2>

    @auth
        <form action="<?php echo e(route('comments.store', $article)); ?>" method="POST" style="margin-bottom:20px;">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="Ваш комментарий..." required></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Отправить</button>
        </form>
    @else
        <p><a href="<?php echo e(route('login')); ?>">Войдите</a>, чтобы оставить комментарий.</p>
    @endauth

    @forelse ($article->comments as $comment)
        <div class="comment">
            <div class="author"><?php echo e($comment->user->name); ?> <span class="date"><?php echo e($comment->created_at->format('d.m.Y H:i')); ?></span></div>
            <p><?php echo e($comment->body); ?></p>
            @auth
                @if ($comment->user_id === auth()->id() || auth()->user()->isAdmin())
                    <form action="<?php echo e(route('comments.destroy', $comment)); ?>" method="POST" data-confirm="Удалить комментарий?">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Удалить</button>
                    </form>
                @endif
            @endauth
        </div>
    @empty
        <p>Комментариев пока нет.</p>
    @endforelse
@endsection
