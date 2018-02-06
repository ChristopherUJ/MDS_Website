<div class="page-header">
    <h1>Editing Select Group</h1>
</div>

<?php echo render('admin/select/groups/_form'); ?>


<div class="form-actions">
    <?php echo Html::anchor('admin/selectgroups/view/' . $select_group->id, 'View', array('class' => 'btn')); ?>   
    <?php echo Html::anchor('admin/selectgroups', 'Back', array('class' => 'btn')); ?>
</div>