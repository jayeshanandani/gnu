<div class="scheduleExams form">
<?php echo $this->Form->create('ScheduleExam'); ?>
	<fieldset>
		<legend><?php echo __('Edit Schedule Exam'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
		echo $this->Form->input('recstatus');
		echo $this->Form->input('academic_year_id');
		echo $this->Form->input('degree_id');
		echo $this->Form->input('session_no');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ScheduleExam.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ScheduleExam.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Schedule Exams'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Academic Years'), array('controller' => 'academic_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic Year'), array('controller' => 'academic_years', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees'), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exam Masters'), array('controller' => 'exam_masters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam Master'), array('controller' => 'exam_masters', 'action' => 'add')); ?> </li>
	</ul>
</div>
