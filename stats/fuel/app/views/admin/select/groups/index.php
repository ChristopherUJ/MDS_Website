<div class="page-header">
    <h1>Listing Select Groups</h1>
</div>

<?php if ($select_groups): ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($select_groups as $select_group): ?>        
                <tr>
                    <td><?php echo $select_group->name; ?></td>
                    <td><?php echo $select_group->description; ?></td>
                    <td>
                        <?php echo Html::anchor('admin/selectgroups/view/' . $select_group->id, 'View'); ?> |
                        <?php echo Html::anchor('admin/selectgroups/edit/' . $select_group->id, 'Edit'); ?> |
                        <?php echo Html::anchor('admin/selectgroups/delete/' . $select_group->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>            
                    </td>
                </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>

<?php else: ?>
    <p>No Select Groups.</p>
<?php endif; ?>
<div class="form-actions">
    <?php echo Html::anchor('admin/selectgroups/create', 'Add new Select Group', array('class' => 'btn btn-success')); ?>
</div>
