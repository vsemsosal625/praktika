<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Sport;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Управление новостями/аналитикой (ТЗ п.4.1, админ)
class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['sport', 'author'])->latest()->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create', [
            'article' => new Article(),
            'sports' => Sport::orderBy('name')->get(),
            'tournaments' => Tournament::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['user_id'] = $request->user()->id;
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? ($data['published_at'] ?? now()) : null;

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('status', 'Статья создана.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'sports' => Sport::orderBy('name')->get(),
            'tournaments' => Tournament::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $data = $this->validateData($request);
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && ! $article->published_at) {
            $data['published_at'] = $data['published_at'] ?? now();
        }
        if (! $data['is_published']) {
            $data['published_at'] = null;
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('status', 'Статья обновлена.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('status', 'Статья удалена.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:news,analytics,announcement'],
            'sport_id' => ['nullable', 'exists:sports,id'],
            'tournament_id' => ['nullable', 'exists:tournaments,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'url', 'max:500'],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'article';
        $slug = $base;
        $i = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
