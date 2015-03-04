<div class="table-responsive">
<div class="events view">
<h2><?php echo __('FeedbackEvent'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($feedbackevent['FeedbackEvent']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
			<?php if($feedbackevent['FeedbackEvent']['recstatus'] ==1 ){
				echo "Active";
				} else {
					echo "Deactive";
				} ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>