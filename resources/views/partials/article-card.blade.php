@php($typeLabels = ['news' => 'Новость', 'analytics' => 'Аналитика', 'announcement' => 'Анонс'])
<article class="card">
    @if ($article->image)
        <img src=" $article->image " alt="" class="card-img">
    @endif
    <div class="card-body">
        <div class="meta">
            <span class="badge"> $typeLabels[$article->type] ?? 'Новость' </span>
            @if ($article->sport)<span class="badge badge-accent"> $article->sport->name </span>@endif
        </div>
        <h3><a href=" route('articles.show', $article) "> $article->title </a></h3>
        <p class="meta"> optional($article->published_at)->format('d.m.Y')  &middot;  $article->views  просмотров</p>
        <p> $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->body), 120) </p>
        <a href=" route('articles.show', $article) " class="btn btn-primary btn-sm">Читать</a>
    </div>
</article>
