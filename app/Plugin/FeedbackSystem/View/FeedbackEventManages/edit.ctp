<div class="row">
          <div class="col-lg-6">
<div class="FeedbackEventManages form">
<?php echo $this->Form->create('FeedbackEventManage', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
)); ?>
	<fieldset>
		<legend><?php echo __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
		echo $this->Form->input('recstatus');
		echo $this->Form->input('event_id');
		echo $this->Form->input('staff_id');
	?>
	<?php echo $this->Form->submit('Save changes', array(
				'div' => false,
				'class' => 'btn btn-primary'
			)); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>