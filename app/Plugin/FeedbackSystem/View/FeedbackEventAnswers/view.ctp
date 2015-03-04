<div class="feedbackAnswers view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Feedback Answer'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Feedback Answer'), array('action' => 'edit', $feedbackAnswer['FeedbackAnswer']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Feedback Answer'), array('action' => 'delete', $feedbackAnswer['FeedbackAnswer']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $feedbackAnswer['FeedbackAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Feedback Answers'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Feedback Answer'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Created By'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created By'); ?></th>
		<td>
			<?php echo $this->Html->link($feedbackAnswer['CreatedBy']['id'], array('controller' => 'users', 'action' => 'view', $feedbackAnswer['CreatedBy']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified By'); ?></th>
		<td>
			<?php echo $this->Html->link($feedbackAnswer['ModifiedBy']['id'], array('controller' => 'users', 'action' => 'view', $feedbackAnswer['ModifiedBy']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Recstatus'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['recstatus']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Question Id'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['question_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Answer Id'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['answer_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Answer'); ?></th>
		<td>
			<?php echo h($feedbackAnswer['FeedbackAnswer']['answer']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

