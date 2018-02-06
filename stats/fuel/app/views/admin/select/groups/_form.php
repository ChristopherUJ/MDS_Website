<?php echo Form::open(array('class' => 'form form-horizontal')); ?><fieldset>
            <div class="control-group">
            <?php echo Form::label('Name', 'name', array('class' => 'control-label')); ?>

             <div class="controls">
                				<?php echo Form::input('name', Input::post('name', isset($select_group) ? $select_group->name : ''), array('class' => 'span6')); ?>

            </div>
        </div>
            <div class="control-group">
            <?php echo Form::label('Description', 'description', array('class' => 'control-label')); ?>

             <div class="controls">
                				<?php echo Form::input('description', Input::post('description', isset($select_group) ? $select_group->description : ''), array('class' => 'span6')); ?>

            </div>
        </div>
        <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>