<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['creator_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['modifier_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recstatus'); ?></dt>
		<dd>
			<?php echo h($user['User']['recstatus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fullname'); ?></dt>
		<dd>
			<?php echo h($user['User']['fullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['role_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Type'); ?></dt>
		<dd>
			<?php echo h($user['User']['user_type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets'), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Logs'), array('controller' => 'user_logs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Log'), array('controller' => 'user_logs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Tickets'); ?></h3>
	<?php if (!empty($user['Ticket'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Recstatus'); ?></th>
		<th><?php echo __('Ticket No'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Staff Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Complain'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Dateclosed'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Ticket'] as $ticket): ?>
		<tr>
			<td><?php echo $ticket['id']; ?></td>
			<td><?php echo $ticket['created']; ?></td>
			<td><?php echo $ticket['creator_id']; ?></td>
			<td><?php echo $ticket['modified']; ?></td>
			<td><?php echo $ticket['modifier_id']; ?></td>
			<td><?php echo $ticket['recstatus']; ?></td>
			<td><?php echo $ticket['ticket_no']; ?></td>
			<td><?php echo $ticket['user_id']; ?></td>
			<td><?php echo $ticket['staff_id']; ?></td>
			<td><?php echo $ticket['category_id']; ?></td>
			<td><?php echo $ticket['subject']; ?></td>
			<td><?php echo $ticket['complain']; ?></td>
			<td><?php echo $ticket['status_id']; ?></td>
			<td><?php echo $ticket['dateclosed']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tickets', 'action' => 'view', $ticket['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tickets', 'action' => 'edit', $ticket['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tickets', 'action' => 'delete', $ticket['id']), null, __('Are you sure you want to delete # %s?', $ticket['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ticket'), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Logs'); ?></h3>
	<?php if (!empty($user['UserLog'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Module'); ?></th>
		<th><?php echo __('Action'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserLog'] as $userLog): ?>
		<tr>
			<td><?php echo $userLog['id']; ?></td>
			<td><?php echo $userLog['user_id']; ?></td>
			<td><?php echo $userLog['created']; ?></td>
			<td><?php echo $userLog['ip']; ?></td>
			<td><?php echo $userLog['module']; ?></td>
			<td><?php echo $userLog['action']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_logs', 'action' => 'view', $userLog['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_logs', 'action' => 'edit', $userLog['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_logs', 'action' => 'delete', $userLog['id']), null, __('Are you sure you want to delete # %s?', $userLog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Log'), array('controller' => 'user_logs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
