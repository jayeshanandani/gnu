<div class="table-responsive">
<style type="text/css">
	th{
		width: 20%;
	}
</style>
<div class="students view">
<h2><?php echo __('Personal Profile'); ?></h2>
<table class="table table-striped">
		<tr><th><?php echo __('Firstname'); ?></th>
		<td>
			<?php echo h($staff['Staff']['firstname']); ?>
			&nbsp;
		</td></tr>
		<tr><th><?php echo __('Lastname'); ?></th>
		<td>
			<?php echo h($staff['Staff']['lastname']); ?>
			&nbsp;
		</td></tr>
		<tr><th><?php echo __('Institution'); ?></th>
		<td>
		<?php echo $staff['Institution']['name']; ?>
		</td></tr>
		<tr><th><?php echo __('Department'); ?></th>
		<td>
		
			<?php echo $staff['Department']['name']; ?>
	
		</td></tr>
		<tr><th><?php echo __('Email-Id'); ?></th>
		<td>
		<?php echo AuthComponent::user('email'); ?>
		</td></tr>
</table>
</div>
</style>

