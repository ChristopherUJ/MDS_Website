<?php echo Form::open(array('class' => 'form form-horizontal')); ?>
<fieldset>
    <?php echo Form::hidden('select_group_id', Input::post('select_group_id', isset($select_option) ? $select_option->select_group_id : $select_group->id), array('class' => 'span6')); ?>
    <div class="control-group">
        <?php echo Form::label('Select Group', '', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo Form::input('', $select_group->name, array('class' => 'span6', 'readonly' => 'readonly')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo Form::label('Value', 'value', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo Form::input('value', Input::post('value', isset($select_option) ? $select_option->value : ''), array('class' => 'span6')); ?>

        </div>
    </div>
    <div class="control-group">
        <?php echo Form::label('Status', 'status_id', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo Form::select('status_id', Input::post('status_id', isset($select_option) ? $select_option->status_id : ''), Model_Select_Group::getSelectOptionsAsArray(Model_Select_Group::GROUP_STATUSES, true), array('class' => 'span6')); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>        
        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>