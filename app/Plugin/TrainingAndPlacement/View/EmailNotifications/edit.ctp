
<div class="emailNotifications form">
<?php echo $this->Form->create('EmailNotification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Email Notification'); ?></legend>
	<?php
		echo $this->Form->input('to');
		echo $this->Form->input('flag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EmailNotification.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EmailNotification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Email Notifications'), array('action' => 'index')); ?></li>
	</ul>
</div>
