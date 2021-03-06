<?php  
	echo $this->Html->css('TrainingAndPlacement.jquery-ui-1.10.4.custom');
	echo $this->Html->script('TrainingAndPlacement.jquery-ui.min');
	echo $this->Html->script('TrainingAndPlacement.jquery-ui-1.10.4.custom.min');
?>

<script type="text/javascript">
var dateToday = new Date();
	$(document).ready(function(){
    	$("#datepicker1").datepicker({
        	minDate: dateToday,
        	maxDate: "+60D",
        	numberOfMonths: 2,
        	dateFormat: "dd-mm-yy",
        	onSelect: function(selected) {
          $("#datepicker2").datepicker("option","minDate", selected)
        }
    });
    $("#datepicker2").datepicker({
        minDate: 0,
        maxDate:"+60D",
        numberOfMonths: 2,
        dateFormat: "dd-mm-yy",
        onSelect: function(selected) {
           $("#datepicker3").datepicker("option","minDate", selected)
        }
    }); 
    $("#datepicker3").datepicker({
        minDate: 0,
        maxDate:"+60D",
        numberOfMonths: 2,
        dateFormat: "dd-mm-yy",
        onSelect: function(selected) {
           $("#datepicker4").datepicker("option","minDate", selected)
        }
    }); 
    $("#datepicker4").datepicker({
        minDate: 0,
        maxDate:"+60D",
        numberOfMonths: 2,
        dateFormat: "dd-mm-yy",
        onSelect: function(selected) {
           $("#datepicker5").datepicker("option",dateToday, selected)
        }
    }); 
    $("#datepicker5").datepicker({
        minDate: 0,
        maxDate:"+60D",
        numberOfMonths: 2,
        dateFormat: "dd-mm-yy",
        onSelect: function(selected) {
           $("#datepicker1").datepicker("option",dateToday, selected)
        }
    }); 
});

	</script>
<div class="row">
          <div class="col-lg-6">
<div class="companyVisits form">
<?php echo $this->Form->create('CompanyVisit', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Add Company Visit'); ?></legend>
	<?php
		//echo $this->Form->input('company_master_id');
		echo $this->Form->input('pptdate', ['type' => 'text','id' => 'datepicker1', 'label' => 'Pre-Placement Talk Date', 'placeholder' => 'Enter date for Pre-Placement Talk Session']);
		echo $this->Form->input('visitdate1', ['type' => 'text','id' => 'datepicker2', 'label' => '1st Priority for Visit', 'placeholder' => 'Enter 1st priority date for campus placement']);
		echo $this->Form->input('visitdate2', ['type' => 'text','id' => 'datepicker3', 'label' => '2nd Priority for Visit', 'placeholder' => 'Enter 2nd priority date for campus placement']);
		echo $this->Form->input('visitdate3', ['type' => 'text','id' => 'datepicker4', 'label' => '3rd Priority for Visit', 'placeholder' => 'Enter 3rd priority date for campus placement']);
		echo $this->Form->input('lastdate', ['type' => 'text','id' => 'datepicker5', 'label' => 'Last date To apply for placement', 'placeholder' => 'Enter last date to apply for campus placement']);
		echo $this->Form->input('placementtype', ['label' => 'Placement Type', 'placeholder' => 'e.g. campus placement, off campus etc']);
		echo $this->Form->input('placementvenue', ['label' => 'Placement Venue', 'placeholder' => 'Enter venue for placement']);

		echo $this->Form->input('prefered_time', ['label' => 'Preferred Time', 'placeholder' => 'Enter your prefered time for arrival']);

	?>
	<div class="col col-md-9 col-md-offset-3">
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
			<button type="reset" class="btn btn-default">Cancel</button>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div></div>
