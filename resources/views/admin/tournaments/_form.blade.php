<div class="form-group"><label>Название</label><input type="text" name="name" value="<?php echo e(old('name', $tournament->name)); ?>" class="form-control" required></div>
<div class="form-group">
    <label>Вид спорта</label>
    <select name="sport_id" class="form-control" required>
        @foreach ($sports as $sport)
            <option value="<?php echo e($sport->id); ?>" <?php echo e((int) old('sport_id', $tournament->sport_id) === $sport->id ? 'selected' : ''); ?>><?php echo e($sport->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group"><label>Страна</label><input type="text" name="country" value="<?php echo e(old('country', $tournament->country)); ?>" class="form-control"></div>
<div class="form-group"><label>Сезон</label><input type="text" name="season" value="<?php echo e(old('season', $tournament->season)); ?>" class="form-control" placeholder="2025/2026"></div>
<div class="form-group"><label>Описание</label><textarea name="description" class="form-control"><?php echo e(old('description', $tournament->description)); ?></textarea></div>
