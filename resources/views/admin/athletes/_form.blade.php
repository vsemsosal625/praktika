<div class="form-group"><label>Имя</label><input type="text" name="name" value="<?php echo e(old('name', $athlete->name)); ?>" class="form-control" required></div>
<div class="form-group">
    <label>Вид спорта</label>
    <select name="sport_id" class="form-control" required>
        @foreach ($sports as $sport)
            <option value="<?php echo e($sport->id); ?>" <?php echo e((int) old('sport_id', $athlete->sport_id) === $sport->id ? 'selected' : ''); ?>><?php echo e($sport->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Команда</label>
    <select name="team_id" class="form-control">
        <option value="">— без команды —</option>
        @foreach ($teams as $team)
            <option value="<?php echo e($team->id); ?>" <?php echo e((int) old('team_id', $athlete->team_id) === $team->id ? 'selected' : ''); ?>><?php echo e($team->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group"><label>Страна</label><input type="text" name="country" value="<?php echo e(old('country', $athlete->country)); ?>" class="form-control"></div>
<div class="form-group"><label>Амплуа / позиция</label><input type="text" name="position" value="<?php echo e(old('position', $athlete->position)); ?>" class="form-control"></div>
<div class="form-group"><label>Дата рождения</label><input type="date" name="birth_date" value="<?php echo e(old('birth_date', optional($athlete->birth_date)->format('Y-m-d'))); ?>" class="form-control"></div>
<div class="form-group"><label>URL фото</label><input type="url" name="photo" value="<?php echo e(old('photo', $athlete->photo)); ?>" class="form-control"></div>
<div class="form-group"><label>Биография</label><textarea name="bio" class="form-control"><?php echo e(old('bio', $athlete->bio)); ?></textarea></div>
