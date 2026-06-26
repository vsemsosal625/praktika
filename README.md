# Веб-приложение «Спортивные соревнования»

Веб-приложение для публикации новостей, аналитики, результатов и рейтингов по различным видам спорта. Реализовано на **Laravel 11** согласно ТЗ ГБПОУИО «ИАТ».

## Стек технологий

| Компонент | Версия |
|-----------|--------|
| PHP | 8.2+ |
| Laravel | 11 |
| MySQL | 8.4 LTS |
| Node.js | 20+ |
| Composer | 2.7 |
| npm | 10.8 |
| Веб-сервер | Nginx 1.24 / Apache |

## Роли и функции

- **Гость** — просмотр ленты новостей/аналитики/анонсов, турнирных таблиц, расписания и архива результатов, поиск и фильтрация, карточки команд и спортсменов.
- **Пользователь** — всё вышеперечисленное + регистрация/авторизация, комментарии (создание/редактирование/удаление своих), личный профиль.
- **Администратор** — всё выше + CRUD статей, управление результатами/таблицами/статистикой, справочниками (виды спорта, турниры, команды, спортсмены), модерация комментариев, управление пользователями (блокировка).

## Безопасность (п. 4.4 ТЗ)

- Аутентификация по email и паролю.
- Пароли хранятся хешированными алгоритмом **Argon2id** (`config/hashing.php`).
- Сессионный токен с ограниченным временем жизни **60 минут** (`SESSION_LIFETIME=60`), обновляется при смене пароля и при входе.
- Проверка прав доступа на сервере через middleware `auth`, `not.blocked`, `admin`.
- Валидация на клиенте (HTML5 + JS) и строгая повторная валидация на сервере.
- Защита от SQL-инъекций: используется Eloquent ORM / параметризованные запросы.

## Установка

```bash
# 1. Клонировать репозиторий
git clone https://github.com/vsemsosal625/praktika.git
cd praktika

# 2. Установить PHP-зависимости
composer install

# 3. Установить JS-зависимости
npm install

# 4. Настроить окружение
cp .env.example .env
php artisan key:generate

# 5. Указать данные БД в .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
#    И создать БД, например: CREATE DATABASE sport_competitions;

# 6. Миграции и тестовые данные
php artisan migrate --seed

# 7. Сборка фронтенда
npm run build      # или npm run dev для разработки

# 8. Запуск
php artisan serve
```

Приложение будет доступно на http://127.0.0.1:8000

## Тестовые учётные записи

| Роль | Email | Пароль |
|------|-------|--------|
| Администратор | `admin@sport.local` | `admin12345` |
| Пользователь | `user@sport.local` | `user12345` |

## Резервное копирование БД (п. 4.3 ТЗ)

В проект встроена Artisan-команда резервного копирования:

```bash
php artisan db:backup
```

Копии сохраняются в `storage/app/backups/` (хранятся последние 14 резервных копий). Ежедневный запуск уже настроен в `routes/console.php` (в 03:00).

### Linux (cron)
Чтобы расписание Laravel работало, добавьте в crontab:
```cron
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

### Windows Server 2022 (Планировщик заданий)
Создайте задачу, запускающую каждую минуту:
```
php C:\path-to-project\artisan schedule:run
```

### Ручной бэкап через mysqldump
```bash
mysqldump -u root -p sport_competitions > backup_$(date +%F).sql
```

## Восстановление БД из резервной копии

```bash
# 1. (при необходимости) создать пустую БД
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS sport_competitions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 2. Импортировать дамп
mysql -u root -p sport_competitions < storage/app/backups/backup_2026-06-26.sql
```

После восстановления очистите кэш конфигурации: `php artisan config:clear`.

## Структура проекта

```
app/
  Console/Commands/BackupDatabase.php   # команда db:backup
  Http/Controllers/                     # публичные + Auth + Admin контроллеры
  Http/Middleware/                      # EnsureUserIsAdmin, EnsureUserIsNotBlocked
  Models/                               # User, Sport, Tournament, Team, Athlete, Article, Comment, MatchGame, Standing
database/migrations/                    # схема БД
database/seeders/DatabaseSeeder.php     # тестовые данные
resources/views/                        # Blade-шаблоны (публичные + admin)
routes/web.php, routes/admin.php        # маршруты
```
