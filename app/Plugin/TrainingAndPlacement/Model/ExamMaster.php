<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ExamMaster Model
 *
 * @property Student $Student
 * @property Semester $Semester
 * @property ExamYear $ExamYear
 */
class ExamMaster extends TrainingAndPlacementAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ScheduleExam' => array(
			'className' => 'ScheduleExam',
			'foreignKey' => 'schedule_exam_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
