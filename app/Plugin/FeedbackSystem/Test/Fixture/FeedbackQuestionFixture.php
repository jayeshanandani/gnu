<?php
/**
 * FeedbackQuestionFixture
 *
 */
class FeedbackQuestionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'creator_id' => array('type' => 'biginteger', 'null' => false, 'default' => '1'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modifier_id' => array('type' => 'biginteger', 'null' => false, 'default' => '1'),
		'category_id' => array('type' => 'biginteger', 'null' => false, 'default' => null),
		'inform_id' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'recstatus' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'text' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'created' => '2014-10-10 21:11:30',
			'creator_id' => '',
			'modified' => '2014-10-10 21:11:30',
			'modifier_id' => '',
			'category_id' => '',
			'inform_id' => 1,
			'recstatus' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'text' => 'Lorem ipsum dolor sit amet'
		),
	);

}
