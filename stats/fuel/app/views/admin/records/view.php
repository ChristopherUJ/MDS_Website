<div class="span12">
    <div class="page-header">
        <h1>Viewing #<?php echo $record->id; ?></h1>
    </div>
    <p>
        <strong>Mmsi:</strong>
        <?php echo $record->mmsi; ?>
    </p>
    <p>
        <strong>Country:</strong>
        <?php echo $record->country; ?>
    </p>
    <p>
        <strong>Ship name:</strong>
        <?php echo $record->ship_name; ?>
    </p>
    <p>
        <strong>Imo number:</strong>
        <?php echo $record->imo_number; ?>
    </p>
    <p>
        <strong>Ship type:</strong>
        <?php echo $record->ship_type; ?>
    </p>
    <p>
        <strong>Destination:</strong>
        <?php echo $record->destination; ?>
    </p>
    <p>
        <strong>Length:</strong>
        <?php echo $record->length; ?>
    </p>
    <p>
        <strong>Breadth:</strong>
        <?php echo $record->breadth; ?>
    </p>
    <p>
        <strong>Maximum actual draught:</strong>
        <?php echo $record->maximum_actual_draught; ?>
    </p>
    <p>
        <strong>To country:</strong>
        <?php echo $record->to_country; ?>
    </p>
    <p>
        <strong>To port:</strong>
        <?php echo $record->to_port; ?>
    </p>
    <p>
        <strong>In country:</strong>
        <?php echo $record->in_country; ?>
    </p>
    <p>
        <strong>In port:</strong>
        <?php echo $record->in_port; ?>
    </p>
    <p>
        <strong>From country:</strong>
        <?php echo $record->from_country; ?>
    </p>
    <p>
        <strong>From port:</strong>
        <?php echo $record->from_port; ?>
    </p>

    <p>
        <strong>Latitude / Longitude:</strong>
        <?php echo PositioningUtils::pretty_print_coordinates($record->latitude, $record->longitude); ?>
    </p>

    <div class="form-actions">
        <?php echo Html::anchor('admin/records/edit/' . $record->id, 'Edit', array('class' => 'btn')); ?>
        <?php echo Html::anchor('admin/records', 'Back', array('class' => 'btn')); ?>  
    </div>
</div>