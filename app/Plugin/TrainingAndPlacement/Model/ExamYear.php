<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ExamYear Model
 *
 * @property AcademicYear $AcademicYear
 * @property Semester $Semester
 * @property ExamMaster $ExamMaster
 */
class ExamYear extends TrainingAndPlacementAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'AcademicYear' => array(
			'className' => 'AcademicYear',
			'foreignKey' => 'academic_year_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Semester' => array(
			'className' => 'Semester',
			'foreignKey' => 'semester_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TrainingAndPlacement.ExamMaster' => array(
			'className' => 'ExamMaster',
			'foreignKey' => 'exam_year_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
