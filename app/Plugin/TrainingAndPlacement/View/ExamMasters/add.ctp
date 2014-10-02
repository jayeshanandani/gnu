<div class="examMasters form">
<?php echo $this->Form->create('ExamMaster'); ?>
	<fieldset>
		<legend><?php echo __('Add Exam Master'); ?></legend>
	<?php
		echo $this->Form->input('student_id');
		echo $this->Form->input('semester_id');
		echo $this->Form->input('exam_year_id');
		echo $this->Form->input('s_credits_offered');
		echo $this->Form->input('s_credits_earned');
		echo $this->Form->input('s_grade_points_earned');
		echo $this->Form->input('s_credit_points_earned');
		echo $this->Form->input('sgpa');
		echo $this->Form->input('s_backlog');
		echo $this->Form->input('c_credits_offered');
		echo $this->Form->input('c_credits_earned');
		echo $this->Form->input('c_grade_points_earned');
		echo $this->Form->input('c_credit_points_earned');
		echo $this->Form->input('cgpa');
		echo $this->Form->input('c_backlog');
		echo $this->Form->input('result');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Exam Masters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exam Years'), array('controller' => 'exam_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam Year'), array('controller' => 'exam_years', 'action' => 'add')); ?> </li>
	</ul>
</div>
