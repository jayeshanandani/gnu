<div class="row">
          <div class="col-lg-6">
<div class="feedbackSettings form">
<?php echo $this->Form->create('FeedbackSetting', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Setting'); ?></legend>
	<?php
		echo $this->Form->input('pagination_value',['placeholder'=>'Enter value of pagination between 1 to 50']);
	
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