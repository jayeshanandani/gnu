<div class="placementResults form">
<?php echo $this->Form->create('PlacementResult'); ?>
	<fieldset>
		<legend><?php echo __('Add Placement Result'); ?></legend>
	<?php
	//	echo $this->Form->input('creator_id');
	//	echo $this->Form->input('modifier_id');
	//	echo $this->Form->input('recstatus');
	//	echo $this->Form->input('student_id');
		echo $this->Form->input('company_master_id');
	//	echo $this->Form->input('aptitude');
	//	echo $this->Form->input('interview');
	//	echo $this->Form->input('gd');
	//	echo $this->Form->input('hr');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Apply For This Company')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Placement Results'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Company Masters'), array('controller' => 'company_masters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company Master'), array('controller' => 'company_masters', 'action' => 'add')); ?> </li>
	</ul>
</div>
