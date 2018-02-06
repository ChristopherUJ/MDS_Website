<div class="span6 offset3">
    <div class="page-header">
        <h1>Login</h1>
    </div>
    
    <?php echo Form::open(array('class' => 'form-horizontal')); ?>

    <?php if (isset($_GET['destination'])): ?>
        <?php echo Form::hidden('destination', $_GET['destination']); ?>
    <?php endif; ?>

    <?php if (isset($login_error)): ?>
        <div class="error"><?php echo $login_error; ?></div>
    <?php endif; ?>

    <fieldset>
        <div class="control-group">
            <label for="email" class="control-label">Email or Username:</label>
            <div class="controls"><?php echo Form::input('email', Input::post('email'), array('class' => 'input-medium')); ?></div>
            <?php if ($val->error('email')): ?>
                <div class="error"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></div>
            <?php endif; ?>
        </div>
    </fieldset>

    <fieldset>
        <div class="control-group">
            <label for="password" class="control-label">Password:</label>
            <div class="controls"><?php echo Form::password('password', '', array('class' => 'input-medium')); ?></div>
            <?php if ($val->error('password')): ?>
                <div class="error"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></div>
            <?php endif; ?>
        </div>
    </fieldset>

    <div class="form-actions">
        <?php echo Form::submit(array('value' => 'Login', 'name' => 'submit', 'class' => 'btn btn-primary')); ?>
    </div>

    <?php echo Form::close(); ?>  
</div>