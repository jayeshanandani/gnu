<div class="academicYears view">
<h2><?php echo __('Academic Year'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator Id'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['creator_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier Id'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['modifier_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recstatus'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['recstatus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($academicYear['AcademicYear']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Academic Year'), array('action' => 'edit', $academicYear['AcademicYear']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Academic Year'), array('action' => 'delete', $academicYear['AcademicYear']['id']), null, __('Are you sure you want to delete # %s?', $academicYear['AcademicYear']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Academic Years'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Academic Year'), array('action' => 'add')); ?> </li>
	</ul>
</div>
