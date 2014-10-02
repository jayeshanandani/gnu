<?php
App::uses('AppModel', 'Model');
/**
 * ScheduleExam Model
 *
 * @property AcademicYear $AcademicYear
 * @property Degree $Degree
 * @property ExamMaster $ExamMaster
 */
class ScheduleExam extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'schedule_exam';


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
		'Degree' => array(
			'className' => 'Degree',
			'foreignKey' => 'degree_id',
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
			'foreignKey' => 'schedule_exam_id',
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
