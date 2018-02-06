<div class="span12">
    <div class="page-header">
        <h1>Editing User</h1>
    </div>

    <?php echo render('admin/users/_form'); ?>
    <div class="form-actions">
        <?php echo Html::anchor('admin/users/view/' . $user->id, 'View', array('class' => 'btn')); ?>
        <?php echo Html::anchor('admin/users', 'Back', array('class' => 'btn')); ?>
    </div>
</div>
