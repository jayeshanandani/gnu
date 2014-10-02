<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * ResultsBoard Model
 *
 * @property Student $Student
 */
class ResultsBoard extends TrainingAndPlacementAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

    public $belongsTo = ['TrainingAndPlacement.Student'];
}
