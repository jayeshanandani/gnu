<?php
App::uses('FeedbackQuestionsController', 'FeedbackSystem.Controller');

/**
 * FeedbackQuestionsController Test Case
 *
 */
class FeedbackQuestionsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.feedback_system.feedback_question',
		'plugin.feedback_system.user',
		'plugin.feedback_system.ticket',
		'plugin.feedback_system.role',
		'plugin.feedback_system.user_role'
	);

}
