<div class="page-header">
    <h1>Select Group: <?php echo $select_group->name; ?></h1>
</div>

<p>
    <strong>Name:</strong>
    <?php echo $select_group->name; ?>    
</p>
<p>
    <strong>Description:</strong>
    <?php echo $select_group->description; ?>    
</p>

<div class="page-header">
    <h3>Select Group: Options</h3>
</div>
<table class="table table-striped table-condensed table-bordered">
    <thead>
        <tr>
            <th class="header">Value</th>
            <th class="header">Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($select_group->select_options as $select_option): ?>	
            <tr>
                <td><?php echo $select_option->value; ?></td>
                <td><?php echo $select_option->getStatus(); ?></td>
                <td>
                    <?php echo Html::anchor('admin/selectoptions/edit/' . $select_option->id, 'Edit'); ?> |
                    <?php echo Html::anchor('admin/selectoptions/delete/' . $select_option->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div class="form-actions">
    <?php echo Html::anchor('admin/selectgroups/edit/' . $select_group->id, 'Edit', array('class' => 'btn btn-primary')); ?>    
    <?php echo Html::anchor('admin/selectoptions/create/' . $select_group->id, 'Add new Select Option', array('class' => 'btn btn-success')); ?>  
    <?php echo Html::anchor('admin/selectgroups', 'Back', array('class' => 'btn')); ?>   
</div>
