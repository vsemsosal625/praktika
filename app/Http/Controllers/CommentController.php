<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

// Комментарии зарегистрированных пользователей (ТЗ п.4.1, роль Пользователь)
class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'min:2', 'max:2000'],
        ]);

        $article->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return back()->with('status', 'Комментарий добавлен.');
    }

    public function update(Request $request, Comment $comment)
    {
        // Проверка прав на сервере: редактировать можно только своё
abort_unless($comment->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'body' => ['required', 'string', 'min:2', 'max:2000'],
        ]);

        $comment->update(['body' => $data['body']]);

        return back()->with('status', 'Комментарий обновлён.');
    }

    public function destroy(Request $request, Comment $comment)
    {
        // Удалять может автор либо админ (модерация)
        abort_unless($comment->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        $comment->delete();

        return back()->with('status', 'Комментарий удалён.');
    }
}
