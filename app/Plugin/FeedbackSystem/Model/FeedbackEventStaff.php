<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackEventStaff Model
 *
 */
class FeedbackEventStaff extends FeedbackSystemAppModel {

	

public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = [];

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
   public $belongsTo = ['Institution','Department'];

/**
 * hasMany associations
 *
 * @var array
 */
       public $hasMany = ['FeedbackSystem.FeedbackEventManage,FeedbackSystem.FeedbackEventStaff'];
		
		public function getListByDepartment($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.department_id' => $cid),
		));
	}
 }
