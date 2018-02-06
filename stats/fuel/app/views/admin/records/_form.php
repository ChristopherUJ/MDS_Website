<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Mmsi', 'mmsi'); ?>

			<div class="input">
				<?php echo Form::input('mmsi', Input::post('mmsi', isset($record) ? $record->mmsi : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Country', 'country'); ?>

			<div class="input">
				<?php echo Form::input('country', Input::post('country', isset($record) ? $record->country : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Ship name', 'ship_name'); ?>

			<div class="input">
				<?php echo Form::input('ship_name', Input::post('ship_name', isset($record) ? $record->ship_name : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Imo number', 'imo_number'); ?>

			<div class="input">
				<?php echo Form::input('imo_number', Input::post('imo_number', isset($record) ? $record->imo_number : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Ship type', 'ship_type'); ?>

			<div class="input">
				<?php echo Form::input('ship_type', Input::post('ship_type', isset($record) ? $record->ship_type : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Destination', 'destination'); ?>

			<div class="input">
				<?php echo Form::input('destination', Input::post('destination', isset($record) ? $record->destination : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Length', 'length'); ?>

			<div class="input">
				<?php echo Form::input('length', Input::post('length', isset($record) ? $record->length : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Breadth', 'breadth'); ?>

			<div class="input">
				<?php echo Form::input('breadth', Input::post('breadth', isset($record) ? $record->breadth : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Maximum actual draught', 'maximum_actual_draught'); ?>

			<div class="input">
				<?php echo Form::input('maximum_actual_draught', Input::post('maximum_actual_draught', isset($record) ? $record->maximum_actual_draught : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('To country', 'to_country'); ?>

			<div class="input">
				<?php echo Form::input('to_country', Input::post('to_country', isset($record) ? $record->to_country : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('To port', 'to_port'); ?>

			<div class="input">
				<?php echo Form::input('to_port', Input::post('to_port', isset($record) ? $record->to_port : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('In country', 'in_country'); ?>

			<div class="input">
				<?php echo Form::input('in_country', Input::post('in_country', isset($record) ? $record->in_country : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('In port', 'in_port'); ?>

			<div class="input">
				<?php echo Form::input('in_port', Input::post('in_port', isset($record) ? $record->in_port : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('From country', 'from_country'); ?>

			<div class="input">
				<?php echo Form::input('from_country', Input::post('from_country', isset($record) ? $record->from_country : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('From port', 'from_port'); ?>

			<div class="input">
				<?php echo Form::input('from_port', Input::post('from_port', isset($record) ? $record->from_port : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>