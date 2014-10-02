<div class="academicYears form">
<?php echo $this->Form->create('AcademicYear'); ?>
	<fieldset>
		<legend><?php echo __('Add Academic Year'); ?></legend>
	<?php
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
		echo $this->Form->input('recstatus');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Academic Years'), array('action' => 'index')); ?></li>
	</ul>
</div>
