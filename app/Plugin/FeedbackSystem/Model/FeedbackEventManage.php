<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackEventManage Model
 *
 * @property Creator $Creator
 * @property Modifier $Modifier
 * @property Event $Event
 * @property Staff $Staff
 */
class FeedbackEventManage extends FeedbackSystemAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'recstatus' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array('FeedbackSystem.FeedbackEvent','Staff');
}
