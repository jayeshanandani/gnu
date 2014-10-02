<div class="examYears form">
<?php echo $this->Form->create('ExamYear'); ?>
	<fieldset>
		<legend><?php echo __('Edit Exam Year'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('year');
		echo $this->Form->input('academic_year_id');
		echo $this->Form->input('semester_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ExamYear.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ExamYear.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Exam Years'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Academic Years'), array('controller' => 'academic_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic Year'), array('controller' => 'academic_years', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exam Masters'), array('controller' => 'exam_masters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam Master'), array('controller' => 'exam_masters', 'action' => 'add')); ?> </li>
	</ul>
</div>
