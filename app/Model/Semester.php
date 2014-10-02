<?php
App::uses('AppModel', 'Model');
/**
 * Semester Model
 *
 * @property AcademicYear $AcademicYear
 * @property Degree $Degree
 */
class Semester extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'semesters';

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
	/*public $hasMany = array(
		'.Degree',
	); */
	public $belongsTo = array(
		'AcademicYear' => array(
			'className' => 'AcademicYear',
			'foreignKey' => 'academic_year_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Degree' => array(
			'className' => 'Degree',
			'foreignKey' => 'degree_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
public function getListByDegree($cid = null) {
		if (empty($cid)) {
			return array();
		}
		return $this->find('list', array(
			'conditions' => array($this->alias . '.degree_id' => $cid),
			//'order' => array($this->alias.'.name'=>'ASC')
		));
	}
	

	
}
