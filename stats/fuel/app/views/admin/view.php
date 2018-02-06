<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<div class="span12">
    <div class="page-header">
        <h1>Viewing #<?php echo $record->id; ?></h1>
    </div>
    <div class="row">
        <div class="span3">
            <p>
                <strong>MMSI:</strong>
                <?php echo $record->mmsi; ?>
            </p>
            <p>
                <strong>IMO number:</strong>
                <?php echo $record->imo_number; ?>
            </p>
            <p>
                <strong>Country:</strong>
                <?php echo $record->country; ?>
            </p>
            <p>
                <strong>Ship Name:</strong>
                <?php echo $record->ship_name; ?>
            </p>
            <p>
                <strong>Ship Type:</strong>
                <?php echo $record->ship_type; ?>
            </p>
            <p>
                <strong>Destination:</strong>
                <?php echo $record->destination; ?>
            </p>
            <p>
                <strong>Length:</strong>
                <?php echo $record->getLength(); ?>
            </p>
            <p>
                <strong>Breadth:</strong>
                <?php echo $record->getBreadth(); ?>
            </p>
            <p>
                <strong>Maximum Actual Draught:</strong>
                <?php echo $record->getMaximumActualDraught(); ?>
            </p>
            <p>
                <strong>To Country:</strong>
                <?php echo $record->to_country; ?>
            </p>
            <p>
                <strong>To Port:</strong>
                <?php echo $record->to_port; ?>
            </p>
            <p>
                <strong>In Country:</strong>
                <?php echo $record->in_country; ?>
            </p>
            <p>
                <strong>In Port:</strong>
                <?php echo $record->in_port; ?>
            </p>
            <p>
                <strong>From Country:</strong>
                <?php echo $record->from_country; ?>
            </p>
            <p>
                <strong>From Port:</strong>
                <?php echo $record->from_port; ?>
            </p>
            <p>
                <strong>Latitude / Longitude:</strong>
                <?php echo PositioningUtils::pretty_print_coordinates($record->latitude, $record->longitude); ?>
            </p>
            <p>
                <strong>Timestamp:</strong>
                <?php echo date('d-M-Y H:i:s', $record->time_stamp); ?>
            </p>
        </div>
        <div class="span9">
            <div id="map" style="width: 800px; height: 520px;"></div>
        </div>
    </div>
    <div class="form-actions">
        <?php echo Html::anchor('#', 'Back', array('class' => 'btn', 'onclick' => 'window.history.back();return false;')); ?>  
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#map').gmap3(
        { 
            action: 'addMarker',
            address: '<?php echo PositioningUtils::pretty_print_coordinates($record->latitude, $record->longitude); ?>',
            map:{
                center: true,
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.HYBRID,
                streetViewControl: false
            }
        });
    });
</script>