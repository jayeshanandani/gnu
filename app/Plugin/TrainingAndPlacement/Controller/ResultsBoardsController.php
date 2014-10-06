<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ResultsBoardsController extends TrainingAndPlacementAppController {

	public function result_board_form() {
		if ($this->request->is('post') && $this->request->data['ResultsBoard']['degree_id']!=0) {
			$institute	= $this->request->data['ResultsBoard']['institution_id'];
			$department = $this->request->data['ResultsBoard']['department_id'];
			$degree 	= $this->request->data['ResultsBoard']['degree_id'];
			return $this->redirect(['action' => 'index', $institute, $department, $degree]);
		}
		unset($this->request->data['ResultsBoard']['institution_id']);
		$this->loadModel('Institution');
		$institutions	= $this->Institution->find('list');
		$departments	= [];
		$degrees		= [];
		$this->set(compact('institutions', 'departments', 'degrees'));	
	}

	public function index($institute = null, $department = null, $degree = null) {
		$this->loadModel('Setting');
		$data				= $this->Setting->find('first');
		$pagination_value 	= $data['Setting']['pagination_value'];
		$student_list		= $this->ResultsBoard->Student->find('list',array('conditions' => array('Student.institution_id' => $institute,'Student.degree_id' => $degree)));
		$this->Paginator->settings = ['limit' => $pagination_value,'page' => 1,
			'contain'		=> ['Student' => ['conditions' => ['Student.id' => $student_list]]],
			'conditions'	=> ['ResultsBoard.student_id' => $student_list]
		];
		$this->set('ResultsBoards', $this->Paginator->paginate());
	}

	public function display() {
		$resultsBoards = $this->ResultsBoard->find('all',['conditions' => ['ResultsBoard.student_id' => $this->Auth->user('student_id')]]);
		$this->set('resultsBoards', $resultsBoards);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ResultsBoard->exists($id)) {
			throw new NotFoundException(__('Invalid results board'));
		}
		$options = array('conditions' => array('ResultsBoard.' . $this->ResultsBoard->primaryKey => $id));
		$this->set('resultsBoard', $this->ResultsBoard->find('first', $options));
	}
}
