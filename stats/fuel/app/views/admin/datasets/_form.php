<?php echo Form::open(array('class' => 'form-stacked')); ?>

<fieldset>
    <div class="clearfix">
        <?php echo Form::label('User id', 'user_id'); ?>

        <div class="input">
            <?php echo Form::input('user_id', Input::post('user_id', isset($dataset) ? $dataset->user_id : ''), array('class' => 'span6')); ?>

        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Status id', 'status_id'); ?>

        <div class="input">
            <?php echo Form::input('status_id', Input::post('status_id', isset($dataset) ? $dataset->status_id : ''), array('class' => 'span6')); ?>

        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('File name', 'file_name'); ?>

        <div class="input">
            <?php echo Form::input('file_name', Input::post('file_name', isset($dataset) ? $dataset->file_name : ''), array('class' => 'span6')); ?>

        </div>
    </div>
    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

    </div>
</fieldset>
<?php echo Form::close(); ?>