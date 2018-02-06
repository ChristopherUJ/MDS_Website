<div class="page-header">
    <h1>New Select Option</h1>
</div>
<?php echo render('admin/select/options/_form'); ?>

<div class="form-actions">
    <?php echo Html::anchor('admin/selectgroups/view/' . $select_group->id, 'Back', array('class' => 'btn')); ?>
</div>
