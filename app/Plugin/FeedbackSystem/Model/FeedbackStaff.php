<?php
App::uses('FeedbackSystemAppModel', 'FeedbackSystem.Model');
/**
 * FeedbackStaff Model
 *
 * @property Creator $Creator
 * @property Modifier $Modifier
 * @property Institution $Institution
 * @property Department $Department
 */
class FeedbackStaff extends FeedbackSystemAppModel {
	

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

      public $hasMany = ['FeedbackSystem.FeedbackManage,FeedbackSystem.FeedbackStaff'];
		public function getListByDepartment($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.department_id' => $cid),
		));
	}


}
