<div class="row">
<div class="col-lg-6">
<div class="feedbackEventStaff form">
<?php echo $this->Form->create('FeebackEventStaff', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Add Staff'); ?></legend>
	<?php
	
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('pincode');
		echo $this->Form->input('address');
		echo $this->Form->input('staffstatus');
		echo $this->Form->input('institution_id');
		echo $this->Form->input('department_id');
		
	?>
	<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>