<h2>Editing Dataset</h2>
<br>

<?php echo render('admin\datasets/_form'); ?>
<p>
	<?php echo Html::anchor('admin/datasets/view/'.$dataset->id, 'View'); ?> |
	<?php echo Html::anchor('admin/datasets', 'Back'); ?></p>
