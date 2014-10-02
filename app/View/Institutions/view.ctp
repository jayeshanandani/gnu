<div class="institutions view">
<h2><?php echo __('Institution'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator Id'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['creator_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier Id'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['modifier_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recstatus'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['recstatus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Institution'), array('action' => 'edit', $institution['Institution']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Institution'), array('action' => 'delete', $institution['Institution']['id']), null, __('Are you sure you want to delete # %s?', $institution['Institution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Departments'); ?></h3>
	<?php if (!empty($institution['Department'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Recstatus'); ?></th>
		<th><?php echo __('Institution Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($institution['Department'] as $department): ?>
		<tr>
			<td><?php echo $department['id']; ?></td>
			<td><?php echo $department['created']; ?></td>
			<td><?php echo $department['creator_id']; ?></td>
			<td><?php echo $department['modified']; ?></td>
			<td><?php echo $department['modifier_id']; ?></td>
			<td><?php echo $department['recstatus']; ?></td>
			<td><?php echo $department['institution_id']; ?></td>
			<td><?php echo $department['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'departments', 'action' => 'view', $department['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'departments', 'action' => 'edit', $department['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'departments', 'action' => 'delete', $department['id']), null, __('Are you sure you want to delete # %s?', $department['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
