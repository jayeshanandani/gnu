<?php
/**
 * FeedbackCategoryFixture
 *
 */
class FeedbackCategoryFixture extends CakeTestFixture {

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
		'recstatus' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'flag' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 20),
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
			'created' => '2014-09-03 14:40:47',
			'creator_id' => '',
			'modified' => '2014-09-03 14:40:47',
			'modifier_id' => '',
			'recstatus' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'flag' => 1
		),
	);

}
