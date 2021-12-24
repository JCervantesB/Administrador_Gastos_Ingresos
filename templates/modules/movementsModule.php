<h4 class="d-flex justify-content-between align-items-center mb-3">
  <span class="text-muted">Movimientos</span>
  <span class="badge badge-secondary badge-pill"><?php echo $d->cal->total_movements; ?></span>
</h4>
<ul class="list-group mb-3">
  <?php foreach ($d->movements as $mov): ?>
    <li class="list-group-item d-flex justify-content-between lh-condensed
    <?php echo $mov->type === 'income' ? '' : 'bg-light'; ?> bee_movement" data-id="<?php echo $mov->id; ?>">  
      <div class="text-<?php echo $mov->type === 'income' ? 'success' : 'danger'; ?>">
        <h6 class="my-0"><?php echo $mov->type === 'income' ? 'Ingreso' : 'Gasto'; ?></h6>
        <small class="text-muted"><?php echo $mov->description; ?></small>
      </div>
      <button class="btn btn-sm btn-danger float-right bee_delete_movement" data-id="<?php echo $mov->id; ?>"><i class="fas fa-trash"></i></button>
      <span class="text-<?php echo $mov->type === 'income' ? 'success' : 'danger'; ?>">
        <?php echo $mov->type === 'income' ? '' : '-'; ?>
        <?php echo money($mov->amount); ?>
      </span>
    </li>   
  <?php endforeach; ?>
  
</ul>

<ul class="list-group mb-3">
  <li class="list-group-item d-flex justify-content-between">
    <span>Subtotal (MXN)</span>
    <strong><?php echo money($d->cal->subtotal); ?></strong>
  </li>

  
  <li class="list-group-item d-flex justify-content-between">
    <span>Impuestos (16%)</span>
    <strong><?php echo money($d->cal->taxes); ?></strong>
  </li>
  

  <li class="list-group-item d-flex justify-content-between">
    <span>Total (MXN)</span>
    <strong><?php echo money($d->cal->total); ?></strong>
  </li>
</ul>