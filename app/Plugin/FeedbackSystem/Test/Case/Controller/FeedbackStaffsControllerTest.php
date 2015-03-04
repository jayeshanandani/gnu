<?php
App::uses('FeedbackStaffsController', 'FeedbackSystem.Controller');

/**
 * FeedbackStaffsController Test Case
 *
 */
class FeedbackStaffsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.feedback_system.feedback_staff',
		'plugin.feedback_system.user',
		'plugin.feedback_system.ticket',
		'plugin.feedback_system.role',
		'plugin.feedback_system.user_role'
	);

}
