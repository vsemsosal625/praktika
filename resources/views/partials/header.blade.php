<header class="site-header">
    <div class="container">
        <nav class="navbar">
            <a href=" route('home') " class="brand">🏆 Спортивные соревнования</a>
            <div class="nav-links">
                <a href=" route('articles.index') ">Новости</a>
                <a href=" route('tournaments.index') ">Турниры</a>
                <a href=" route('teams.index') ">Команды</a>
                <a href=" route('athletes.index') ">Спортсмены</a>
            </div>
            <form action=" route('search') " method="GET" class="search-form">
                <input type="text" name="q" value=" request('q') " placeholder="Поиск...">
                <button class="btn btn-accent btn-sm" type="submit">Найти</button>
            </form>
            <div class="nav-links">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href=" route('admin.dashboard') ">Админка</a>
                    @endif
                    <a href=" route('profile.edit') "> auth()->user()->name </a>
                    <form action=" route('logout') " method="POST">
                        @csrf
                        <button class="btn btn-light btn-sm" type="submit">Выйти</button>
                    </form>
                @else
                    <a href=" route('login') ">Вход</a>
                    <a href=" route('register') " class="btn btn-accent btn-sm">Регистрация</a>
                @endauth
            </div>
        </nav>
    </div>
</header>
