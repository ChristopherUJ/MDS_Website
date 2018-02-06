<h2>Editing Record</h2>
<br>

<?php echo render('records/_form'); ?>
<p>
	<?php echo Html::anchor('records/view/'.$record->id, 'View'); ?> |
	<?php echo Html::anchor('records', 'Back'); ?></p>
