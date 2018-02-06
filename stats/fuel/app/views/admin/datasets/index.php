<div class="span12">
    <div class="page-header">
        <h1>Listing Datasets <small>Using #<?php echo Model_Setting::getDatasetSettingValue(); ?></small></h1>
    </div>

    <?php if ($datasets): ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>File name</th>
                    <th>Records</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datasets as $dataset): ?>		
                    <tr>
                        <td><?php echo $dataset->id; ?></td>
                        <td><?php echo ucfirst(Model_User::find($dataset->user_id)->username); ?></td>
                        <td><?php echo $dataset->file_name; ?></td>
                        <td><?php echo $dataset->getCountRecords(); ?></td>
                        <td><?php echo $dataset->getStatus(); ?></td>
                        <td><?php echo date('j M Y H:i', $dataset->created_at); ?></td>
                        <td>
                            <?php echo Html::anchor('admin/datasets/setdefault/' . $dataset->id, 'Set As Default'); ?> |
                            <?php echo Html::anchor('admin/datasets/delete/' . $dataset->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>	
            </tbody>
        </table>

    <?php else: ?>
        <p>No Datasets.</p>
    <?php endif; ?>

    <div class="form-actions">
        <?php echo Html::anchor('admin/datasets/create', 'Add new Dataset', array('class' => 'btn btn-success')); ?>
    </div>

</div>