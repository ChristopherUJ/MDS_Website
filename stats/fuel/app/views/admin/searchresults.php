<div class="span12">
    <div class="page-header">
        <h1 class="pull-left">Search Results <small><?php echo $from . '-' . $to; ?> of <?php echo $countRecords; ?> </small></h1>
        <div class="clearfix"></div>
    </div>

    <?php if ($records): ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>MMSI</th>
                    <th>IMO Number</th>
                    <th>Country</th>
                    <th>Ship Name</th>
                    <th>Ship Type</th>
                    <th>To Country</th>
                    <th>To Port</th>
                    <th>From Country</th>
                    <th>From Port</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>		
                    <tr>
                        <td><?php echo $record->mmsi; ?></td>
                        <td><?php echo $record->imo_number; ?></td>
                        <td><?php echo $record->country; ?></td>
                        <td><?php echo $record->ship_name; ?></td>
                        <td><?php echo $record->ship_type; ?></td>
                        <td><?php echo $record->to_country; ?></td>
                        <td><?php echo $record->to_port; ?></td>
                        <td><?php echo $record->from_country; ?></td>
                        <td><?php echo $record->from_port; ?></td>
                        <td>
                            <?php echo Html::anchor('site/view/' . $record->id, 'View'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No Records.</p>
    <?php endif; ?>

    <?php echo \Fuel\Core\Form::open(); ?>
    <?php
    foreach ($posted as $key => $value) {
        if (!empty($value) && $key != 'page')
            echo \Fuel\Core\Form::hidden($key, $value);
    }
    echo \Fuel\Core\Form::hidden('page', '', array('id' => 'pageAction'));
    echo \Fuel\Core\Form::submit('submit', '', array('id' => 'btnSubmit', 'style' => 'display: none;'));
    ?>
    <ul class="pager">
        <?php if ($currentPage > 0) : ?>
            <li class="previous">
                <a href="#" onclick="$('#pageAction').val(<?php echo $currentPage - 1; ?>);$('#btnSubmit').click();return false;">&larr; Previous</a>
            </li>
        <?php endif; ?>
        <?php if ($countPages > $currentPage + 1) : ?>
            <li class="next">
                <a href="#" onclick="$('#pageAction').val(<?php echo $currentPage + 1; ?>);$('#btnSubmit').click();return false;">Next &rarr;</a>
            </li>
        <?php endif; ?>
    </ul>
    <?php \Fuel\Core\Form::close(); ?>

    <div class="form-actions">
        <?php echo Fuel\Core\Html::anchor('site/search', 'New Search', array('class' => 'btn btn-primary')); ?>
    </div>
</div>