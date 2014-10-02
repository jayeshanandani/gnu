<div class="semesters view">
<h2><?php echo __('Semester'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator Id'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['creator_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier Id'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['modifier_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recstatus'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['recstatus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Academic Year'); ?></dt>
		<dd>
			<?php echo $this->Html->link($semester['AcademicYear']['name'], array('controller' => 'academic_years', 'action' => 'view', $semester['AcademicYear']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Degree'); ?></dt>
		<dd>
			<?php echo $this->Html->link($semester['Degree']['name'], array('controller' => 'degrees', 'action' => 'view', $semester['Degree']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Semester'), array('action' => 'edit', $semester['Semester']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Semester'), array('action' => 'delete', $semester['Semester']['id']), null, __('Are you sure you want to delete # %s?', $semester['Semester']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Academic Years'), array('controller' => 'academic_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic Year'), array('controller' => 'academic_years', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees'), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
	</ul>
</div>
