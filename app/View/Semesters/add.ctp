<div class="semesters form">
<?php echo $this->Form->create('Semester'); ?>
	<fieldset>
		<legend><?php echo __('Add Semester'); ?></legend>
	<?php
		echo $this->Form->input('academic_year_id');
		echo $this->Form->input('degree_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Semesters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Academic Years'), array('controller' => 'academic_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic Year'), array('controller' => 'academic_years', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees'), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
	</ul>
</div>
