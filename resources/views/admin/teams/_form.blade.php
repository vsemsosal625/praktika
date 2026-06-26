<div class="form-group"><label>Название</label><input type="text" name="name" value="<?php echo e(old('name', $team->name)); ?>" class="form-control" required></div>
<div class="form-group">
    <label>Вид спорта</label>
    <select name="sport_id" class="form-control" required>
        @foreach ($sports as $sport)
            <option value="<?php echo e($sport->id); ?>" <?php echo e((int) old('sport_id', $team->sport_id) === $sport->id ? 'selected' : ''); ?>><?php echo e($sport->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group"><label>Город</label><input type="text" name="city" value="<?php echo e(old('city', $team->city)); ?>" class="form-control"></div>
<div class="form-group"><label>Страна</label><input type="text" name="country" value="<?php echo e(old('country', $team->country)); ?>" class="form-control"></div>
<div class="form-group"><label>Год основания</label><input type="number" name="founded_year" value="<?php echo e(old('founded_year', $team->founded_year)); ?>" class="form-control"></div>
<div class="form-group"><label>URL логотипа</label><input type="url" name="logo" value="<?php echo e(old('logo', $team->logo)); ?>" class="form-control"></div>
<div class="form-group"><label>Описание</label><textarea name="description" class="form-control"><?php echo e(old('description', $team->description)); ?></textarea></div>
