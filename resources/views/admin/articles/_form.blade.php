<div class="form-group"><label>Заголовок</label><input type="text" name="title" value="<?php echo e(old('title', $article->title)); ?>" class="form-control" required></div>
<div class="form-group">
    <label>Тип</label>
    <select name="type" class="form-control">
        @foreach (['news' => 'Новость', 'analytics' => 'Аналитика', 'announcement' => 'Анонс'] as $val => $label)
            <option value="<?php echo e($val); ?>" <?php echo e(old('type', $article->type) === $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Вид спорта</label>
    <select name="sport_id" class="form-control">
        <option value="">—</option>
        @foreach ($sports as $sport)
            <option value="<?php echo e($sport->id); ?>" <?php echo e((int) old('sport_id', $article->sport_id) === $sport->id ? 'selected' : ''); ?>><?php echo e($sport->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Турнир</label>
    <select name="tournament_id" class="form-control">
        <option value="">—</option>
        @foreach ($tournaments as $t)
            <option value="<?php echo e($t->id); ?>" <?php echo e((int) old('tournament_id', $article->tournament_id) === $t->id ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group"><label>URL изображения</label><input type="url" name="image" value="<?php echo e(old('image', $article->image)); ?>" class="form-control"></div>
<div class="form-group"><label>Краткое описание</label><textarea name="excerpt" class="form-control"><?php echo e(old('excerpt', $article->excerpt)); ?></textarea></div>
<div class="form-group"><label>Текст статьи</label><textarea name="body" class="form-control" style="min-height:220px;" required><?php echo e(old('body', $article->body)); ?></textarea></div>
<div class="form-group"><label><input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published', $article->is_published) ? 'checked' : ''); ?>> Опубликовать</label></div>
