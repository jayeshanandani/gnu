<div class="row">
          <div class="col-lg-6">
<div class="Feedbackeventquestions form">
<?php echo $this->Form->create('FeedbackEventQuestion', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Add Event Feedback Question'); ?></legend>
	<?php

		echo $this->Form->input('text',['autocomplete' => 'off','label'=>'New Event Feedback Question']);
			echo $this->Form->input('feedback_event_id', array(
    'id' => 'feedback_events',
    'options' => $events
));
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