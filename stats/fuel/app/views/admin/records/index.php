<div class="span12">
    <div class="page-header">
        <h1 class="pull-left">Listing Records <small><?php echo $from . '-' . $to; ?> of <?php echo $countRecords; ?> </small></h1>
        <div class="clearfix"></div>
    </div>

    <?php if ($records): ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Mmsi</th>
                    <th>Country</th>
                    <th>Ship name</th>
                    <th>Imo number</th>
                    <th>Ship type</th>
                    <th>To country</th>
                    <th>To port</th>
                    <th>From country</th>
                    <th>From port</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>		
                    <tr>
                        <td><?php echo $record->mmsi; ?></td>
                        <td><?php echo $record->country; ?></td>
                        <td><?php echo $record->ship_name; ?></td>
                        <td><?php echo $record->imo_number; ?></td>
                        <td><?php echo $record->ship_type; ?></td>
                        <td><?php echo $record->to_country; ?></td>
                        <td><?php echo $record->to_port; ?></td>
                        <td><?php echo $record->from_country; ?></td>
                        <td><?php echo $record->from_port; ?></td>
                        <td>
                            <?php echo Html::anchor('admin/records/view/' . $record->id, 'View'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No Records.</p>
    <?php endif; ?>

    <ul class="pager">
        <?php if ($currentPage > 0) : ?>
            <li class="previous">
                <a href="#">&larr; Previous</a>
            </li>
        <?php endif; ?>
        <?php if ($countPages > $currentPage) : ?>
            <li class="next">
                <a href="<?php echo \Fuel\Core\Uri::create('admin/records') . '/listing/' . (intval($currentPage) + 1); ?>">Next &rarr;</a>
            </li>
        <?php endif; ?>
    </ul>

</div>