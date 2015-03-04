
<div class="table-responsive">
<div class="feedbackcategories view">
<h2><?php echo __('Feedback Category'); ?></h2>
	<table class="table table-striped">
		<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($feedbackcategory['FeedbackCategory']['name']); ?>
			&nbsp;
		</td>
		</tr>
		<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
			<?php if($feedbackcategory['FeedbackCategory']['recstatus'] ==1 ){
				echo "Active";
				} else {
					echo "Deactive";
				} ?>
			&nbsp;
		</td>
		</tr>
	</table>
</div>
</div>

