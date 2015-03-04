<div class="row">
          <div class="col-lg-6">
<div class="Feedbackevents form">
<?php echo $this->Form->create('FeedbackEvent', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Add Feedback Event'); ?></legend>
	<?php

		echo $this->Form->input('name',['autocomplete' => 'off','label'=>'New General Feedback Event']);
		echo $this->Form->input('institution_id');
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
