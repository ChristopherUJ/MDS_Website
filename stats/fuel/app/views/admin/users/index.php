<div class="span12">
    <div class="page-header">
        <h1>Listing Users</h1>
    </div>

    <?php if ($users): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Group</th>
                    <th>Email</th>
                    <th>Last login</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>		
                    <tr>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo \Auth::group()->get_name($user->group); ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo date('j M Y H:i', $user->last_login); ?></td>
                        <td>
                            <?php echo Html::anchor('admin/users/view/' . $user->id, 'View'); ?> |
                            <?php echo Html::anchor('admin/users/edit/' . $user->id, 'Edit'); ?> |
                            <?php echo Html::anchor('admin/users/delete/' . $user->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

                        </td>
                    </tr>
                <?php endforeach; ?>	
            </tbody>
        </table>

    <?php else: ?>
        <p>No Users.</p>
    <?php endif; ?>

    <div class="form-actions">
        <?php echo Html::anchor('admin/users/create', 'Add new User', array('class' => 'btn btn-success')); ?>
    </div>

</div>