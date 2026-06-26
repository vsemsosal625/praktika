<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

// Модерация комментариев (ТЗ п.4.1, админ)
class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'article'])->latest()->paginate(30);

        return view('admin.comments.index', compact('comments'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'min:2', 'max:2000'],
        ]);
        $comment->update($data);

        return back()->with('status', 'Комментарий отредактирован.');
    }

    public function toggleHide(Comment $comment)
    {
        $comment->update(['is_hidden' => ! $comment->is_hidden]);

        return back()->with('status', $comment->is_hidden ? 'Комментарий скрыт.' : 'Комментарий опубликован.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('status', 'Комментарий удалён.');
    }
}
