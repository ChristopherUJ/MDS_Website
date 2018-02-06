<div class="span5" style="margin-top: 40px;">
    <div class="page-header">
        <h1>New Session</h1>
    </div>
    <div class="tabbable tabs-left">
        <ul class="nav nav-tabs" id="dashboard-wizard">
            <li class="active"><a href="#step1" data-toggle="tab">1. Choose Zone</a></li>
            <li><a href="#step2" data-toggle="tab">2. Choose Countries</a></li>
            <li><a href="#step3" data-toggle="tab">3. Choose Date Range</a></li>
        </ul>
        <?php echo \Fuel\Core\Form::open(array('id' => 'form-new-session')); ?>
        <div class="tab-content">
            <div class="tab-pane active" id="step1">
                <label class="radio">
                    <input type="radio" name="zone" value="global" checked>
                    Global
                </label>
                <label class="radio">
                    <input type="radio" name="zone" value="africa">
                    Africa
                </label>
                <br>
                <button type="button" class="btn btn-primary" id="btn-choose-zone">Next</button>
            </div>
            <div class="tab-pane" id="step2">                   
                <select name="countries[]" multiple="multiple" style="height: 110px;">
                    <option value="Algeria">Algeria</option>
                    <option value="Angola">Angola</option>
                    <option value="Benin">Benin</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Coted'Ivoire">Coted'Ivoire</option>
                    <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Egypt">Egypt</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Republic of the Congo">Republic of the Congo</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="The Gambia">The Gambia</option>
                    <option value="Togo">Togo</option>
                    <option value="Tunisia">Tunisia</option>
                </select>
                <label for="countries">(Hold CTRL to select multiple options.)</label>
                <br>
                <button type="button" class="btn btn-primary" id="btn-choose-country">Next</button>
            </div>
            <div class="tab-pane" id="step3">
                <div class="controls">
                    <button type="button" class="btn" id="btn-choose-date-range" style="margin: 5px 0px;"><i class="icon-calendar icon-large"></i>Choose Date Range</button>
                </div> 
                <div class="controls">
                    <?php echo \Fuel\Core\Form::input('dateStart', \Fuel\Core\Input::post('dateStart'), array('readonly' => 'readonly', 'class' => 'input-small')); ?>
                </div>
                <div class="controls">
                    <?php echo \Fuel\Core\Form::input('dateEnd', \Fuel\Core\Input::post('dateEnd'), array('readonly' => 'readonly', 'class' => 'input-small')); ?>
                </div>
                <br><br>
                <?php echo \Fuel\Core\Form::submit('submit', 'Start Session', array('class' => 'btn btn-success')); ?>
            </div>
        </div>
        <?php echo \Fuel\Core\Form::close(); ?>
    </div>
</div>
<div class="span5 offset2" style="margin-top: 40px;">
    <?php echo Fuel\Core\Asset::img('map.png'); ?>
</div>
<script>
    $(function(){
        $('#btn-choose-zone').click(function(){
            var zone = $('#form-new-session input[name="zone"]:checked').val();
            if (zone == 'global')
                $('#dashboard-wizard a[href="#step3"]').tab('show');
            else
                $('#dashboard-wizard a[href="#step2"]').tab('show');
        });
        
        $('#btn-choose-country').click(function(){
            if ($('#form-new-session select[name="countries[]"]').val())
                $('#dashboard-wizard a[href="#step3"]').tab('show');
            else
                alert('Please select atleast 1 country');
        });
        
        $('#btn-choose-date-range').daterangepicker(
        {
            ranges: {
                'Today': ['today', 'today'],
                'Last 7 Days': [Date.today().add({ days: -6 }), 'today'],
                'Last 30 Days': [Date.today().add({ days: -29 }), 'today']
            }
        }, 
        function(start, end) {
            $('#form-new-session input[name="dateStart"]').val(start.toString('dd-MM-yyyy'));
            $('#form-new-session input[name="dateEnd"]').val(end.toString('dd-MM-yyyy'));
        }
    );
            
        $('#form-new-session').submit(function(){
            if ( $('#form-new-session input[name="dateStart"]').val() &&
                $('#form-new-session input[name="dateEnd"]').val())
                return true;
            else {
                alert('Please choose a date range');
                return false;
            }
        });
    });
</script>