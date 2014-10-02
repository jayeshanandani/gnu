<div class="departments view">
<h2><?php echo __('Department'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($department['Department']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($department['Department']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator Id'); ?></dt>
		<dd>
			<?php echo h($department['Department']['creator_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($department['Department']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier Id'); ?></dt>
		<dd>
			<?php echo h($department['Department']['modifier_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recstatus'); ?></dt>
		<dd>
			<?php echo h($department['Department']['recstatus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institution'); ?></dt>
		<dd>
			<?php echo $this->Html->link($department['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $department['Institution']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($department['Department']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Department'), array('action' => 'edit', $department['Department']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Department'), array('action' => 'delete', $department['Department']['id']), null, __('Are you sure you want to delete # %s?', $department['Department']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees'), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Degrees'); ?></h3>
	<?php debug($department['Degree']); ?>
	<?php if (!empty($department['Degree'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Recstatus'); ?></th>
		<th><?php echo __('Department Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($department['Degree'] as $degree): ?>
		<tr>
			<td><?php echo $degree['id']; ?></td>
			<td><?php echo $degree['created']; ?></td>
			<td><?php echo $degree['creator_id']; ?></td>
			<td><?php echo $degree['modified']; ?></td>
			<td><?php echo $degree['modifier_id']; ?></td>
			<td><?php echo $degree['recstatus']; ?></td>
			<td>	<?php echo $this->Html->link($department['Department']['name'], array('controller' => 'institutions', 'action' => 'view', $degree['id'])); ?></td>
			<td><?php echo $degree['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'degrees', 'action' => 'view', $degree['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'degrees', 'action' => 'edit', $degree['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'degrees', 'action' => 'delete', $degree['id']), null, __('Are you sure you want to delete # %s?', $degree['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Degree'), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
