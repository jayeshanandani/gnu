<?php
App::uses('AppModel', 'Model');
/**
 * AcademicYear Model
 *
 */
class AcademicYear extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $belongsTo = array(
		'Institution'
	);

	public function getListByInstitution($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.institution_id' => $cid),
			//'order' => array($this->alias.'.name'=>'ASC')
		));
	}
}
