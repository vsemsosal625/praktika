<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

// Управление пользователями: блокировка/разблокировка (ТЗ п.4.1, админ)
class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->validate(['q' => ['nullable', 'string', 'max:120']])['q'] ?? '';
        $users = User::query()
            ->when($q !== '', fn ($query) => $query->where(fn ($w) => $w->where('name', 'like', '%'.$q.'%')->orWhere('email', 'like', '%'.$q.'%')))
            ->latest()->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function toggleBlock(Request $request, User $user)
    {
        // Нельзя заблокировать самого себя
        abort_if($user->id === $request->user()->id, 403, 'Нельзя заблокировать свой аккаунт.');

        $user->update(['is_blocked' => ! $user->is_blocked]);

        return back()->with('status', $user->is_blocked ? 'Пользователь заблокирован.' : 'Пользователь разблокирован.');
    }

    public function toggleRole(Request $request, User $user)
    {
        abort_if($user->id === $request->user()->id, 403);
        $user->update(['role' => $user->isAdmin() ? 'user' : 'admin']);

        return back()->with('status', 'Роль пользователя изменена.');
    }
}
