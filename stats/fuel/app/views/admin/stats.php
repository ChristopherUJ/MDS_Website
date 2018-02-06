<?php
$filtersApplied = (Input::post('filter_length') || Input::post('filter_draft') || Input::post('filter_type') || Input::post('filter_destination') || Input::post('filter_in_port') || Input::post('filter_in_country'));
$locationType = \Fuel\Core\Input::post('location_type', Model_Record::LOCATION_TYPE_IN_AREA);
//
// Prepare stats data
//
$vesselStatsHolder = Model_Dataset::getHorizontalGraphDataForRecords($lengthStats);
$typeStatsHolder = Model_Dataset::getHorizontalGraphDataForRecords($typeStats);
$draftStatsHolder = Model_Dataset::getHorizontalGraphDataForRecords($draftStats);
$destinationStatsHolder = $locationType == Model_Record::LOCATION_TYPE_IN_AREA ? Model_Dataset::getVerticalGraphDataForRecords(array_slice($destinationStats, 0, 28)) : null;
$portStatsHolder = $locationType == Model_Record::LOCATION_TYPE_IN_PORT ? Model_Dataset::getVerticalGraphDataForRecords(array_slice($portStats, 0, 28)) : null;
$countryStatsHolder = $locationType == Model_Record::LOCATION_TYPE_NOT_IN_PORT ? Model_Dataset::getVerticalGraphDataForRecords(array_slice($countryStats, 0, 28)) : null;
?>
<div class="span12">
    <div class="page-header">
        <h1><?php echo $title; ?> <small><?php echo $subtitle; ?></small> <small class="pull-right" style="margin-top: 13px;"><?php echo $dateRange; ?></small></h1>
    </div>
    <ul class="nav nav-tabs pull-left">
        <li class="active"><a href="#charts" data-toggle="tab" class="tab_selector">Charts</a></li>
        <li><a href="#tables" data-toggle="tab" class="tab_selector">Tables</a></li>
    </ul>
    <div id="chart-controls">
        <div class="btn-group">
            <button class="btn btn-primary" onclick="$('#modal-filters').modal();">Filters</button>
            <button class="btn btn-warning" <?php if (!$filtersApplied) echo 'disabled="disabled"'; ?> onclick="location.reload();">Clear Filters</button>
        </div>
        <div class="btn-group" data-toggle="buttons-radio">
            <button type="button" class="btn btn-info <?php echo $locationType == Model_Record::LOCATION_TYPE_IN_AREA ? 'active' : '' ?>" onclick="switchLocationType(<?php echo Model_Record::LOCATION_TYPE_IN_AREA; ?>);">Vessels In Area</button>
            <?php if (Fuel\Core\Session::get('zone') == 'africa') : ?>
                <button type="button" class="btn btn-info <?php echo $locationType == Model_Record::LOCATION_TYPE_IN_PORT ? 'active' : '' ?>" onclick="switchLocationType(<?php echo Model_Record::LOCATION_TYPE_IN_PORT; ?>);">Vessels In Port</button>
                <button type="button" class="btn btn-info <?php echo $locationType == Model_Record::LOCATION_TYPE_NOT_IN_PORT ? 'active' : '' ?>" onclick="switchLocationType(<?php echo Model_Record::LOCATION_TYPE_NOT_IN_PORT; ?>);">Vessels Not In Port</button>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="charts">
            <div id="length_stat" class="md-chart"></div>
            <div id="type_stat" class="md-chart wider"></div>
            <div id="draft_stat" class="md-chart"></div>
            <div id='main_stat' class="md-chart-full span12"></div>
        </div>
        <div class="tab-pane" id="tables">
            <div class="span3">
                <h3>Length Statistics</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Length Range</th>
                            <th>Count</th>
                        </tr>
                    <thead>
                    <tbody>
                        <?php foreach ($lengthStats as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key == '-25 - 0' ? 'UNKNOWN' : $key; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Grand Total</th>
                            <th><?php echo array_sum($lengthStats) - (isset($lengthStats['-25 - 0']) ? intval($lengthStats['-25 - 0']) : 0); ?></th>
                        </tr>
                        <tr>
                            <th>Blank Data</th>
                            <th><?php echo isset($lengthStats['-25 - 0']) ? $lengthStats['-25 - 0'] : '0'; ?></th>
                        </tr>
                        <tr>
                            <th>Total Ships</th>
                            <th><?php echo array_sum($lengthStats); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="span3">
                <h3>Draft Statistics</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Draft Range</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($draftStats as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key == '-2 - 0' ? 'UNKNOWN' : $key; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Grand Total</th>
                            <th><?php echo array_sum($draftStats) - (isset($draftStats['-2 - 0']) ? intval($draftStats['-2 - 0']) : 0); ?></th>
                        </tr>
                        <tr>
                            <th>Blank Data</th>
                            <th><?php echo isset($draftStats['-2 - 0']) ? $draftStats['-2 - 0'] : '0'; ?></th>
                        </tr>
                        <tr>
                            <th>Total Ships</th>
                            <th><?php echo array_sum($draftStats); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="span3">
                <h3>Type Statistics</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Vessel Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($typeStats as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Grand Total</th>
                            <th><?php echo array_sum($typeStats) - (isset($typeStats['UNKNOWN']) ? intval($typeStats['UNKNOWN']) : 0); ?></th>
                        </tr>
                        <tr>
                            <th>Blank Data</th>
                            <th><?php echo isset($typeStats['UNKNOWN']) ? $typeStats['UNKNOWN'] : '0'; ?></th>
                        </tr>
                        <tr>
                            <th>Total Ships</th>
                            <th><?php echo array_sum($typeStats); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="span3">
                <?php if ($locationType == Model_Record::LOCATION_TYPE_IN_AREA) : ?>
                    <h3>Destination Statistics</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Vessel Destination</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinationStats as $key => $value) : ?>
                                <tr>
                                    <td><?php echo ucwords(strtolower($key)); ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Grand Total</th>
                                <th><?php echo array_sum($destinationStats) - (isset($destinationStats['UNKNOWN']) ? intval($destinationStats['UNKNOWN']) : 0); ?></th>
                            </tr>
                            <tr>
                                <th>Blank Data</th>
                                <th><?php echo isset($destinationStats['UNKNOWN']) ? $destinationStats['UNKNOWN'] : '0'; ?></th>
                            </tr>
                            <tr>
                                <th>Total Ships</th>
                                <th><?php echo array_sum($destinationStats); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php elseif ($locationType == Model_Record::LOCATION_TYPE_IN_PORT) : ?>
                    <h3>Port Statistics</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>In Port</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($portStats as $key => $value) : ?>
                                <tr>
                                    <td><?php echo ucwords(strtolower($key)); ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Grand Total</th>
                                <th><?php echo array_sum($portStats) - (isset($portStats['UNKNOWN']) ? intval($portStats['UNKNOWN']) : 0); ?></th>
                            </tr>
                            <tr>
                                <th>Blank Data</th>
                                <th><?php echo isset($portStats['UNKNOWN']) ? $portStats['UNKNOWN'] : '0'; ?></th>
                            </tr>
                            <tr>
                                <th>Total Ships</th>
                                <th><?php echo array_sum($portStats); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php elseif ($locationType == Model_Record::LOCATION_TYPE_NOT_IN_PORT) : ?>
                    <h3>Country Statistics</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>In Country</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($countryStats as $key => $value) : ?>
                                <tr>
                                    <td><?php echo ucwords(strtolower($key)); ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Grand Total</th>
                                <th><?php echo array_sum($countryStats) - (isset($countryStats['UNKNOWN']) ? intval($countryStats['UNKNOWN']) : 0); ?></th>
                            </tr>
                            <tr>
                                <th>Blank Data</th>
                                <th><?php echo isset($countryStats['UNKNOWN']) ? $countryStats['UNKNOWN'] : '0'; ?></th>
                            </tr>
                            <tr>
                                <th>Total Ships</th>
                                <th><?php echo array_sum($destinationStats); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<div class="modal hide fade" id="modal-filters">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Filter Selection</h3>
    </div>
    <div class="modal-body">
        <div class="filters-container">
            <?php echo \Fuel\Core\Form::open(array('method' => 'post', 'id' => 'form-filters')); ?>
            <?php echo \Fuel\Core\Form::hidden('location_type', $locationType, array('id' => 'location_type')); ?>
            <?php echo \Fuel\Core\Form::hidden('current_tab', \Fuel\Core\Input::post('current_tab', '#charts'), array('id' => 'current_tab')); ?>
            <div class="filters">
                <div class="filter">
                    <h5>Vessel Length</h5>
                    <select name="filter_length[]" data-placeholder="Choose length range(s)" multiple="multiple" class="chosen-select">
                        <?php foreach ($lengthStats as $key => $value): ?>
                            <?php
                            $selected = false;
                            if (Input::post('filter_length')) {
                                if (is_array(Input::post('filter_length')) && in_array($key, Input::post('filter_length')))
                                    $selected = true;
                                else if (Input::post('filter_length') == $key)
                                    $selected = true;
                            }
                            ?>
                            <option <?php if ($selected) echo 'selected="selected"'; ?> value="<?php echo $key; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter">
                    <h5>Vessel Draft</h5>
                    <select name="filter_draft[]" data-placeholder="Choose draft range(s)" multiple="multiple" class="chosen-select">
                        <?php foreach ($draftStats as $key => $value): ?>
                            <?php
                            $selected = false;
                            if (Input::post('filter_draft')) {
                                if (is_array(Input::post('filter_draft')) && in_array($key, Input::post('filter_draft')))
                                    $selected = true;
                                else if (Input::post('filter_draft') == $key)
                                    $selected = true;
                            }
                            ?>
                            <option <?php if ($selected) echo 'selected="selected"'; ?> value="<?php echo $key; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="filters">
                <div class="filter">
                    <h5>Vessel Type</h5>
                    <select name="filter_type[]" data-placeholder="Choose type(s)" multiple="multiple" class="chosen-select">
                        <?php foreach ($typeStats as $key => $value): ?>
                            <?php
                            $selected = false;
                            if (Input::post('filter_type')) {
                                if (is_array(Input::post('filter_type')) && in_array($key, Input::post('filter_type')))
                                    $selected = true;
                                else if (Input::post('filter_type') == $key)
                                    $selected = true;
                            }
                            ?>
                            <option <?php if ($selected) echo 'selected="selected"'; ?> value="<?php echo $key; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter">            
                    <h5>Destination</h5>
                    <select name="filter_destination[]" data-placeholder="Choose destination(s)" multiple="multiple" class="chosen-select">
                        <?php foreach ($destinationStats as $key => $value): ?>
                            <?php
                            $selected = false;
                            if (Input::post('filter_destination')) {
                                if (is_array(Input::post('filter_destination')) && in_array($key, Input::post('filter_destination')))
                                    $selected = true;
                                else if (Input::post('filter_destination') == $key)
                                    $selected = true;
                            }
                            ?>
                            <option <?php if ($selected) echo 'selected="selected"'; ?> value="<?php echo $key; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="filters">
                <div class="filter">
                    <h5>In Port</h5>
                    <select name="filter_in_port[]" data-placeholder="Choose port(s)" multiple="multiple" class="chosen-select">
                        <?php foreach ($portStats as $key => $value): ?>
                            <?php
                            $selected = false;
                            if (Input::post('filter_in_port')) {
                                if (is_array(Input::post('filter_in_port')) && in_array($key, Input::post('filter_in_port')))
                                    $selected = true;
                                else if (Input::post('filter_in_port') == $key)
                                    $selected = true;
                            }
                            ?>
                            <option <?php if ($selected) echo 'selected="selected"'; ?> value="<?php echo $key; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter">      
                    <h5>In Country</h5>
                    <select name="filter_in_country[]" data-placeholder="Choose countries" multiple="multiple" class="chosen-select">
                        <?php foreach ($countryStats as $key => $value): ?>
                            <?php
                            $selected = false;
                            if (Input::post('filter_in_country')) {
                                if (is_array(Input::post('filter_in_country')) && in_array($key, Input::post('filter_in_country')))
                                    $selected = true;
                                else if (Input::post('filter_in_country') == $key)
                                    $selected = true;
                            }
                            ?>
                            <option <?php if ($selected) echo 'selected="selected"'; ?> value="<?php echo $key; ?>"><?php echo $key; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php echo \Fuel\Core\Form::submit('submit-filters', 'Apply Filters', array('class' => 'btn btn-primary')) ?>
            <?php echo \Fuel\Core\Form::close(); ?>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>
<script type="text/javascript">
    function switchLocationType(locationTypeId)
    {
        $('#location_type').val(locationTypeId);
        $('#form-filters').submit();
    }
    
    $(function(){
        // Tab selector
        $('.tab_selector').click(function(){
            $('#current_tab').val($(this).attr('href'));
        });
        
        // Chosen selects
        $('.chosen-select').chosen();
            
        //
        // Draw Graphs
        //
    
        var data = [];
        var markers = {
            data: [],
            markers: {
                show: true,
                position: 'rm',
                labelFormatter: function(obj)
                {
                    return obj.x;
                }
            }
        }
        var defaults =  {   
            title: 'No Title',
            colors: ['#00A8F0'],
            grid: {
                horizontalLines: false,
                verticalLines: false
            },
            bars : {
                show : true,
                horizontal : true,
                shadowSize : 0,
                barWidth : 0.5,
                lineWidth: 0.1,
                fillOpacity: 1
            },
            xaxis: {
                showLabels: false  
            },
            yaxis: {
                ticks: null  
            },
            HtmlText : false,
            mouse: {
                track: true,
                trackDecimals: 0,
                trackFormatter: function(obj)
                {
                    return obj.nearest.yaxis.ticks[obj.index].label + ': ' + obj.x;
                }
            }
        };
            
        // Vessel Length Statistics
        data = <?php echo $vesselStatsHolder['data']; ?>;
        markers.data = data;
        defaults.yaxis.ticks = <?php echo $vesselStatsHolder['ticks']; ?>;
        defaults.title = 'Vessel Length Statistics';
        Flotr.draw(
        document.getElementById("length_stat"),
        [data, markers],
        defaults
    );
        Flotr.EventAdapter.observe(document.getElementById("length_stat"), 'flotr:click', function (e) {
            $('#form-filters select[name="filter_length[]"]').find('option[value="' + e.yaxis.ticks[e.index].label + '"]').attr('selected', 'selected');
            $('#form-filters').submit();
        });
        
        // Vessel Type Statistics
        data = <?php echo $typeStatsHolder['data']; ?>;
        markers.data = data;
        defaults.yaxis.ticks = <?php echo $typeStatsHolder['ticks']; ?>;
        defaults.title = 'Vessel Type Statistics';
        Flotr.draw(
        document.getElementById("type_stat"),
        [data, markers],
        defaults
    );
        Flotr.EventAdapter.observe(document.getElementById("type_stat"), 'flotr:click', function (e) {
            $('#form-filters select[name="filter_type[]"]').find('option[value="' + e.yaxis.ticks[e.index].label + '"]').attr('selected', 'selected');
            $('#form-filters').submit();
        });
    
        // Vessel Draft Statistics
        data = <?php echo $draftStatsHolder['data']; ?>;
        markers.data = data;
        defaults.yaxis.ticks = <?php echo $draftStatsHolder['ticks']; ?>;
        defaults.title = 'Vessel Draft Statistics';
        Flotr.draw(
        document.getElementById("draft_stat"),
        [data, markers],
        defaults
    );
        Flotr.EventAdapter.observe(document.getElementById("draft_stat"), 'flotr:click', function (e) {
            $('#form-filters select[name="filter_draft[]"]').find('option[value="' + e.yaxis.ticks[e.index].label + '"]').attr('selected', 'selected');
            $('#form-filters').submit();
        });
    
        markers = {
            data: [],
            markers: {
                show: true,
                position: 'ct'
            }
        }
        defaults.colors = ['#C0D800'];
        defaults.mouse.trackFormatter = function(obj)
        {
            return obj.nearest.xaxis.ticks[obj.index].label + ': ' + obj.y;
        };
        defaults.bars.horizontal = false;
        defaults.yaxis.showLabels = false;
        defaults.xaxis = {
            showLabels: true,
            ticks: null,
            labelsAngle: 90
        };
<?php if ($locationType == Model_Record::LOCATION_TYPE_IN_AREA) : ?>
            // Vessel Destination Statistics
            data = <?php echo $destinationStatsHolder['data']; ?>;
            defaults.title = 'Vessel Destination Statistics';
            defaults.xaxis.ticks = <?php echo $destinationStatsHolder['ticks']; ?>,
            markers.data = data;
            Flotr.draw(
            document.getElementById('main_stat'),
            [data, markers],
            defaults
        );
            Flotr.EventAdapter.observe(document.getElementById("main_stat"), 'flotr:click', function (e) {
                $('#form-filters select[name="filter_destination[]"]').find('option[value="' + e.xaxis.ticks[e.index].label + '"]').attr('selected', 'selected');
                $('#form-filters').submit();
            });
<?php elseif ($locationType == Model_Record::LOCATION_TYPE_IN_PORT) : ?>
            // Port Statistics
            data = <?php echo $portStatsHolder['data']; ?>;
            defaults.title = 'Port Statistics';
            defaults.xaxis.ticks = <?php echo $portStatsHolder['ticks']; ?>,
            markers.data = data;
            Flotr.draw(
            document.getElementById('main_stat'),
            [data, markers],
            defaults
        );
            Flotr.EventAdapter.observe(document.getElementById("main_stat"), 'flotr:click', function (e) {
                $('#form-filters select[name="filter_in_port[]"]').find('option[value="' + e.xaxis.ticks[e.index].label + '"]').attr('selected', 'selected');
                $('#form-filters').submit();
            });
<?php elseif ($locationType == Model_Record::LOCATION_TYPE_NOT_IN_PORT) : ?>
            // Country Statistics
            data = <?php echo $countryStatsHolder['data']; ?>;
            defaults.title = 'Country Statistics';
            defaults.xaxis.ticks = <?php echo $countryStatsHolder['ticks']; ?>,
            markers.data = data;
            Flotr.draw(
            document.getElementById('main_stat'),
            [data, markers],
            defaults
        );
            Flotr.EventAdapter.observe(document.getElementById("main_stat"), 'flotr:click', function (e) {
                $('#form-filters select[name="filter_in_country[]"]').find('option[value="' + e.xaxis.ticks[e.index].label + '"]').attr('selected', 'selected');
                $('#form-filters').submit();
            });
<?php endif; ?>
        
        // Current tab
        $('a[href="' + $('#current_tab').val() + '"]').tab('show');
    });
</script>