<div class="span12">
    <div class="page-header">
        <h1>Viewing #<?php echo $user->id; ?></h1>
    </div>
    <p>
        <strong>Username:</strong>
        <?php echo $user->username; ?>
    </p>
    <p>
        <strong>Group:</strong>
        <?php echo \Auth::group()->get_name($user->group); ?>
    </p>
    <p>
        <strong>Email:</strong>
        <?php echo $user->email; ?>
    </p>
    <p>
        <strong>Last login:</strong>
        <?php echo $user->last_login; ?>
    </p>
    <div class="form-actions">
        <?php echo Html::anchor('admin/users/edit/' . $user->id, 'Edit', array('class' => 'btn')); ?>
        <?php echo Html::anchor('admin/users', 'Back', array('class' => 'btn')); ?>
    </div>
</div>