<div class="form-group">
    <label>Турнир</label>
    <select name="tournament_id" class="form-control" required>
        @foreach ($tournaments as $t)
            <option value="<?php echo e($t->id); ?>" <?php echo e((int) old('tournament_id', $match->tournament_id) === $t->id ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Хозяева</label>
    <select name="home_team_id" class="form-control" required>
        @foreach ($teams as $team)
            <option value="<?php echo e($team->id); ?>" <?php echo e((int) old('home_team_id', $match->home_team_id) === $team->id ? 'selected' : ''); ?>><?php echo e($team->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Гости</label>
    <select name="away_team_id" class="form-control" required>
        @foreach ($teams as $team)
            <option value="<?php echo e($team->id); ?>" <?php echo e((int) old('away_team_id', $match->away_team_id) === $team->id ? 'selected' : ''); ?>><?php echo e($team->name); ?></option>
        @endforeach
    </select>
</div>
<div class="form-group"><label>Дата и время</label><input type="datetime-local" name="scheduled_at" value="<?php echo e(old('scheduled_at', optional($match->scheduled_at)->format('Y-m-d\TH:i'))); ?>" class="form-control" required></div>
<div class="form-group"><label>Место проведения</label><input type="text" name="venue" value="<?php echo e(old('venue', $match->venue)); ?>" class="form-control"></div>
<div class="grid grid-2">
    <div class="form-group"><label>Счёт хозяев</label><input type="number" name="home_score" value="<?php echo e(old('home_score', $match->home_score)); ?>" class="form-control"></div>
    <div class="form-group"><label>Счёт гостей</label><input type="number" name="away_score" value="<?php echo e(old('away_score', $match->away_score)); ?>" class="form-control"></div>
</div>
<div class="form-group">
    <label>Статус</label>
    <select name="status" class="form-control">
        @foreach (['scheduled' => 'Запланирован', 'live' => 'Идёт', 'finished' => 'Завершён'] as $val => $label)
            <option value="<?php echo e($val); ?>" <?php echo e(old('status', $match->status) === $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
        @endforeach
    </select>
</div>
