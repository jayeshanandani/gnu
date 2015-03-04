<?php
App::uses('StaffsController', 'Feedbacksystem.Controller');

/**
 * StaffsController Test Case
 *
 */
class StaffsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.feedbacksystem.staff',
		'plugin.feedbacksystem.user',
		'plugin.feedbacksystem.ticket',
		'plugin.feedbacksystem.role',
		'plugin.feedbacksystem.user_role'
	);

}
