<div class="form-group"><label>Название</label><input type="text" name="name" value="<?php echo e(old('name', $sport->name)); ?>" class="form-control" required></div>
<div class="form-group"><label>Иконка (эмодзи)</label><input type="text" name="icon" value="<?php echo e(old('icon', $sport->icon)); ?>" class="form-control"></div>
<div class="form-group"><label>Описание</label><textarea name="description" class="form-control"><?php echo e(old('description', $sport->description)); ?></textarea></div>
