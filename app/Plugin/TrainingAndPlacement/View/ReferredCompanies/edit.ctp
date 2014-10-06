<div class="referredCompanies form">
<?php echo $this->Form->create('ReferredCompany'); ?>
	<fieldset>
		<legend><?php echo __('Edit Referred Company'); ?></legend>
	<?php
		echo $this->Form->input('companyname');
		echo $this->Form->input('forTraining');
		echo $this->Form->input('forJob');
		echo $this->Form->input('location');
		echo $this->Form->input('website');
		echo $this->Form->input('companycontact');
		echo $this->Form->input('referance');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ReferredCompany.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ReferredCompany.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Referred Companies'), array('action' => 'index')); ?></li>
	</ul>
</div>
-->