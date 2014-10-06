<?php
App::uses('AppModel', 'Model');
/**
 * ScheduleExam Model
 *
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
	public $belongsTo = [
			'AcademicYear'	=> ['className' => 'AcademicYear','foreignKey' => 'academic_year_id'],
			'Degree'		=> ['className' => 'Degree','foreignKey' => 'degree_id']
	];

	/**
	 * hasMany associations
	 *
	 * @var array
	*/
	public $hasMany = [
		'TrainingAndPlacement.ExamMaster' => ['className' => 'ExamMaster','foreignKey' => 'schedule_exam_id','dependent' => false]
	];

}
