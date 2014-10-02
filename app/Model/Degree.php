<?php
App::uses('AppModel', 'Model');
/**
 * Degree Model
 *
 */
class Degree extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = ['Department'];

	public $hasMany = ['TrainingandPlacement.Student','SupportTicketSystem.Student'];

/**
 * getlistbydepartment
 *
 * @var id
 */
	public function getListByDepartment($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.department_id' => $cid),
			//'order' => array($this->alias.'.name'=>'ASC')
		));
	}
}
