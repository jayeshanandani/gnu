<div class="feedbackAnswers form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Feedback Answer'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('FeedbackAnswer.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('FeedbackAnswer.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Feedback Answers'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Created By'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('FeedbackAnswer', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('creator_id', array('class' => 'form-control', 'placeholder' => 'Creator Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('modifier_id', array('class' => 'form-control', 'placeholder' => 'Modifier Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('recstatus', array('class' => 'form-control', 'placeholder' => 'Recstatus'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('question_id', array('class' => 'form-control', 'placeholder' => 'Question Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('answer_id', array('class' => 'form-control', 'placeholder' => 'Answer Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('answer', array('class' => 'form-control', 'placeholder' => 'Answer'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
