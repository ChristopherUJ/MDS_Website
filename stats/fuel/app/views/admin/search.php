<div class="span12">
    <div class="page-header">
        <h1>Search Records</h1>
    </div>

    <?php echo \Fuel\Core\Form::open(array('class' => 'form-horizontal')); ?>

    <fieldset>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('MMSI', 'mmsi', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('mmsi', Input::post('mmsi', isset($record) ? $record->mmsi : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('IMO number', 'imo_number', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('imo_number', Input::post('imo_number', isset($record) ? $record->imo_number : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Ship Name', 'ship_name', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('ship_name', Input::post('ship_name', isset($record) ? $record->ship_name : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Ship Type', 'ship_type', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('ship_type', Input::post('ship_type', isset($record) ? $record->ship_type : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Length', 'length', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('length', Input::post('length', isset($record) ? $record->length : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Breadth', 'breadth', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('breadth', Input::post('breadth', isset($record) ? $record->breadth : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Maximum Actual Draught', 'maximum_actual_draught', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('maximum_actual_draught', Input::post('maximum_actual_draught', isset($record) ? $record->maximum_actual_draught : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Date Range', 'dateStart', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <div class="input-append">
                            <input class="input-large" id="dateRange" size="16" type="text" readonly="readonly"><button type="button" class="btn" id="btn-choose-date-range"><i class="icon-calendar icon-large"></i></button>
                        </div>
                        <?php echo \Fuel\Core\Form::hidden('dateStart', \Fuel\Core\Input::post('dateStart'), array('id' => 'dateStart')); ?>
                        <?php echo \Fuel\Core\Form::hidden('dateEnd', \Fuel\Core\Input::post('dateEnd'), array('id' => 'dateEnd')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Country', 'country', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('country', Input::post('country', isset($record) ? $record->country : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('Destination', 'destination', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('destination', Input::post('destination', isset($record) ? $record->destination : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('To Country', 'to_country', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('to_country', Input::post('to_country', isset($record) ? $record->to_country : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('To Port', 'to_port', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('to_port', Input::post('to_port', isset($record) ? $record->to_port : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('In Country', 'in_country', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('in_country', Input::post('in_country', isset($record) ? $record->in_country : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('In Port', 'in_port', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('in_port', Input::post('in_port', isset($record) ? $record->in_port : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('From Country', 'from_country', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('from_country', Input::post('from_country', isset($record) ? $record->from_country : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo Form::label('From Port', 'from_port', array('class' => 'control-label')); ?>

                    <div class="controls">
                        <?php echo Form::input('from_port', Input::post('from_port', isset($record) ? $record->from_port : ''), array('class' => 'input-large')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <?php echo Form::submit('submit', 'Search', array('class' => 'btn btn-primary')); ?>
        </div>
    </fieldset>
    <?php echo Form::close(); ?>
</div>
<script type="text/javascript">
    $(function(){
        $('#btn-choose-date-range').daterangepicker(
        {
            ranges: {
                'Today': ['today', 'today'],
                'Last 7 Days': [Date.today().add({ days: -6 }), 'today'],
                'Last 30 Days': [Date.today().add({ days: -29 }), 'today']
            }
        }, 
        function(start, end) {
            $('#dateStart').val(start.toString('dd-MM-yyyy'));
            $('#dateEnd').val(end.toString('dd-MM-yyyy'));
            $('#dateRange').val(start.toString('dd-MM-yyyy') + " to " + end.toString('dd-MM-yyyy'));
        });
    });
</script>