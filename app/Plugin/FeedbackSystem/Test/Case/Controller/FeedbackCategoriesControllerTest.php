<?php
App::uses('FeedbackCategoriesController', 'Feedbacksystem.Controller');

/**
 * FeedbackCategoriesController Test Case
 *
 */
class FeedbackCategoriesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.feedbacksystem.feedback_category',
		'plugin.feedbacksystem.user',
		'plugin.feedbacksystem.ticket',
		'plugin.feedbacksystem.role',
		'plugin.feedbacksystem.user_role'
	);

}
