<?php
/**
 * StaffFixture
 *
 */
class StaffFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'creator_id' => array('type' => 'biginteger', 'null' => false, 'default' => '1', 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modifier_id' => array('type' => 'biginteger', 'null' => false, 'default' => '1', 'key' => 'index'),
		'recstatus' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'firstname' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lastname' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'staffstatus' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'institution_id' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'key' => 'index'),
		'department_id' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'creator_id' => array('column' => 'creator_id', 'unique' => 0),
			'modifier_id' => array('column' => 'modifier_id', 'unique' => 0),
			'institution_id' => array('column' => 'institution_id', 'unique' => 0),
			'department_id' => array('column' => 'department_id', 'unique' => 0)
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
			'created' => '2014-09-05 07:30:42',
			'creator_id' => '',
			'modified' => '2014-09-05 07:30:42',
			'modifier_id' => '',
			'recstatus' => 1,
			'firstname' => 'Lorem ipsum dolor sit amet',
			'lastname' => 'Lorem ipsum dolor sit amet',
			'staffstatus' => 'Lorem ipsum dolor sit ame',
			'institution_id' => '',
			'department_id' => ''
		),
	);

}
