<?php
/**
 * FeedbackStaffFixture
 *
 */
class FeedbackStaffFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'creator_id' => array('type' => 'biginteger', 'null' => false, 'default' => '1'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modifier_id' => array('type' => 'biginteger', 'null' => false, 'default' => '1'),
		'recstatus' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'firstname' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lastname' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'stafffstatus' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'institution_id' => array('type' => 'biginteger', 'null' => true, 'default' => null),
		'department_id' => array('type' => 'biginteger', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'created' => '2014-09-07 11:39:29',
			'creator_id' => '',
			'modified' => '2014-09-07 11:39:29',
			'modifier_id' => '',
			'recstatus' => 1,
			'firstname' => 'Lorem ipsum dolor sit amet',
			'lastname' => 'Lorem ipsum dolor sit amet',
			'stafffstatus' => 'Lorem ipsum dolor sit amet',
			'institution_id' => '',
			'department_id' => ''
		),
	);

}
