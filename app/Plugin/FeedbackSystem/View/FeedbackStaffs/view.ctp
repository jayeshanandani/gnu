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
			<?php echo h($feedbackStaff['FeedbackStaff']['name']); ?>
			&nbsp;
		</td></tr>
		
		<tr><th><?php echo __('Institution'); ?></th>
		<td>
		<?php echo $feedbackStaff['Institution']['name']; ?>
		</td></tr>
		<tr><th><?php echo __('Department'); ?></th>
		<td>
		
			<?php echo $feedbackStaff['Department']['name']; ?>
	
		</td></tr>
		<tr><th><?php echo __('Email-Id'); ?></th>
		<td>
		<?php echo $feedbackStaff['FeedbackStaff']['email']; ?>
		</td></tr>
</table>
</div>
</style>

