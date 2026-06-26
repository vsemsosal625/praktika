@php($typeLabels = ['news' => 'Новость', 'analytics' => 'Аналитика', 'announcement' => 'Анонс'])
<article class="card">
    @if ($article->image)
        <img src="<?php echo e($article->image); ?>" alt="" class="card-img">
    @endif
    <div class="card-body">
        <div class="meta">
            <span class="badge"><?php echo e($typeLabels[$article->type] ?? $article->type); ?></span>
            @if ($article->sport)<span class="badge badge-accent"><?php echo e($article->sport->name); ?></span>@endif
        </div>
        <h3><a href="<?php echo e(route('articles.show', $article)); ?>"><?php echo e($article->title); ?></a></h3>
        <p class="meta"><?php echo e(optional($article->published_at)->format('d.m.Y')); ?> &middot; <?php echo e($article->views); ?> просмотров</p>
        <p><?php echo e($article->excerpt); ?></p>
        <a href="<?php echo e(route('articles.show', $article)); ?>" class="btn btn-primary btn-sm">Читать</a>
    </div>
</article>
