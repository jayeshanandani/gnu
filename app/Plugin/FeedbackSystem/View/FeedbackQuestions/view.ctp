<div class="table-responsive">
<div class="questions view">
<h2><?php echo __('FeedbackQuestion'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('text'); ?></th>
		<td>
			<?php echo h($question['FeedbackQuestion']['text']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
			<?php if($category['FeedbackQuestion']['recstatus'] ==1 ){
				echo "Active";
				} else {
					echo "Deactive";
				} ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>