<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ExamMaster Model
 *
 */
class ExamMaster extends TrainingAndPlacementAppModel {

//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
* belongsTo associations
*
* @var array
*/
 	public $belongsTo = [ 'Student', 'TrainingAndPlacement.ScheduleExam'];
}
