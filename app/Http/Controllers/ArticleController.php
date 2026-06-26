<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Sport;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Лента новостей с фильтрацией (ТЗ п.4.1, гость)
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sport' => ['nullable', 'string', 'exists:sports,slug'],
            'type' => ['nullable', 'in:news,analytics,announcement'],
            'q' => ['nullable', 'string', 'max:120'],
        ]);

        $query = Article::published()->with(['sport', 'author']);

        if (! empty($validated['sport'])) {
            $query->whereHas('sport', fn ($q) => $q->where('slug', $validated['sport']));
        }
        if (! empty($validated['type'])) {
            $query->where('type', $validated['type']);
        }
        if (! empty($validated['q'])) {
            // Параметризованный поиск — защита от SQL-инъекций (ТЗ п.4.2.2)
            $term = '%'.$validated['q'].'%';
            $query->where(fn ($q) => $q->where('title', 'like', $term)->orWhere('excerpt', 'like', $term));
        }

        $articles = $query->latest('published_at')->paginate(9)->withQueryString();
        $sports = Sport::orderBy('name')->get();

        return view('articles.index', compact('articles', 'sports', 'validated'));
    }

    // Просмотр статьи + комментарии
    public function show(Article $article)
    {
        abort_unless($article->is_published && $article->published_at && $article->published_at <= now(), 404);

        $article->increment('views');
        $article->load(['sport', 'author', 'tournament', 'comments' => fn ($q) => $q->where('is_hidden', false)->with('user')]);

        $related = Article::published()
            ->where('sport_id', $article->sport_id)
            ->whereKeyNot($article->id)
            ->latest('published_at')->take(3)->get();

        return view('articles.show', compact('article', 'related'));
    }
}
