<div class="row">
          <div class="col-lg-6">
<div class="questions form">
<?php echo $this->Form->create('FeedbackQuestion', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>

	<fieldset>
		<legend><?php echo __('Edit Question'); ?></legend>
	<?php
		echo $this->Form->input('text',['autocomplete' => 'off','label'=>'New Question']);
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