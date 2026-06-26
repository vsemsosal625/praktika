<div class="form-group">
    <label>Турнир</label>
    <select name="tournament_id" class="form-control" required>
        @foreach ($tournaments as $t)
            <option value="<?php echo e($t->id); ?>" <?php echo e((int) old('tournament_id', $standing->tournament_id) === $t->id ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Команда</label>
    <select name="team_id" class="form-control" required>
        @foreach ($teams as $team)
            <option value="<?php echo e($team->id); ?>" <?php echo e((int) old('team_id', $standing->team_id) === $team->id ? 'selected' : ''); ?>><?php echo e($team->name); ?></option>
        @endforeach
    </select>
</div>
<div class="grid grid-2">
    <div class="form-group"><label>Позиция</label><input type="number" name="position" value="<?php echo e(old('position', $standing->position)); ?>" class="form-control" required></div>
    <div class="form-group"><label>Очки</label><input type="number" name="points" value="<?php echo e(old('points', $standing->points)); ?>" class="form-control" required></div>
    <div class="form-group"><label>Игры</label><input type="number" name="played" value="<?php echo e(old('played', $standing->played)); ?>" class="form-control"></div>
    <div class="form-group"><label>Победы</label><input type="number" name="won" value="<?php echo e(old('won', $standing->won)); ?>" class="form-control"></div>
    <div class="form-group"><label>Ничьи</label><input type="number" name="drawn" value="<?php echo e(old('drawn', $standing->drawn)); ?>" class="form-control"></div>
    <div class="form-group"><label>Поражения</label><input type="number" name="lost" value="<?php echo e(old('lost', $standing->lost)); ?>" class="form-control"></div>
    <div class="form-group"><label>Забито</label><input type="number" name="goals_for" value="<?php echo e(old('goals_for', $standing->goals_for)); ?>" class="form-control"></div>
    <div class="form-group"><label>Пропущено</label><input type="number" name="goals_against" value="<?php echo e(old('goals_against', $standing->goals_against)); ?>" class="form-control"></div>
</div>
