<div class="row">
          <div class="col-lg-6">
<div class="Feedbackquestions form">
<?php echo $this->Form->create('FeedbackQuestion', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Add Feedback Question'); ?></legend>
	<?php
	echo $this->Form->input('feedback_category_id', array(
    'id' => 'feedback_categories',
    'options' => $categories
));
		echo $this->Form->input('text',['autocomplete' => 'off','label'=>'New General Feedback Question']);
	
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