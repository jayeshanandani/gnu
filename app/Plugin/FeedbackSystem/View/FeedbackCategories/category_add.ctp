<div class="row">
          <div class="col-lg-6">
<div class="Feedbackcategories form">
<?php echo $this->Form->create('FeedbackCategory', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Add Feedback Category'); ?></legend>
	<?php

		echo $this->Form->input('name',['autocomplete' => 'off','label'=>'New General Feedback Category']);
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
