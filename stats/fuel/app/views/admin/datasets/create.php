<div class="span12">
    <div class="page-header">
        <h1>New Dataset</h1>
    </div>
    <div class="alert alert-info">
        Please note the file to be uploaded should be an Excel 2003 .xls file and should contain a single sheet. 
    </div>
    <?php echo Form::open(array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
    <?php echo Form::hidden('user_id', Input::post('user_id', isset($dataset) ? $dataset->user_id : ''), array('class' => 'span6')); ?>
    <?php echo Form::hidden('status_id', Input::post('status_id', isset($dataset) ? $dataset->status_id : ''), array('class' => 'span6')); ?>
    <fieldset>
        <div class="control-group">
            <?php echo Form::label('File', 'file_name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo Fuel\Core\Form::file('file_name', array()); ?>
            </div>
        </div>
    </fieldset>
    <div class="form-actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
        <?php echo Html::anchor('admin/datasets', 'Back', array('class' => 'btn')); ?>
    </div>
    <?php echo Form::close(); ?>
</div>