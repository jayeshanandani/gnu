<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ResultsBoardsController extends TrainingAndPlacementAppController {

	public function result_board_form() {
		if ($this->request->is('post') && $this->request->data['ResultsBoard']['degree_id']!=0) {
			$institute = $this->request->data['ResultsBoard']['institution_id'];
			$department = $this->request->data['ResultsBoard']['department_id'];
			$degree = $this->request->data['ResultsBoard']['degree_id'];
			return $this->redirect(array('action' => 'index', $institute, $department, $degree));
		}
		unset($this->request->data['ResultsBoard']['institution_id']);
		$this->loadModel('Institution');
		$institutions = $this->Institution->find('list');
		$departments = array();
		$degrees = array();
		$this->set(compact('institutions', 'departments', 'degrees'));	
	}

	public function index($institute = null, $department = null, $degree = null) {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$student_list = $this->ResultsBoard->Student->find('list',array('conditions' => array('Student.institution_id' => $institute,'Student.degree_id' => $degree)));
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain'=>['Student'=>['conditions'=>['Student.id'=>$student_list]]],
			'conditions' => ['ResultsBoard.student_id' => $student_list]
			);
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

/**
 * add method
 *
 * @return void
 */ //Important Note : Not Currently Used
/*
	public function add() {
		if ($this->request->is('post')) {
			$this->ResultsBoard->create();
			if ($this->ResultsBoard->save($this->request->data)) {
				$this->Session->setFlash(__('The results board has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The results board could not be saved. Please, try again.'));
			}
		}
		$students = $this->ResultsBoard->Student->find('list');
		$this->set(compact('students'));
	}
*/
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ //Important Note : Not Currently Used
/*	public function edit($id = null) {
		if (!$this->ResultsBoard->exists($id)) {
			throw new NotFoundException(__('Invalid results board'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ResultsBoard->save($this->request->data)) {
				$this->Session->setFlash(__('The results board has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The results board could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ResultsBoard.' . $this->ResultsBoard->primaryKey => $id));
			$this->request->data = $this->ResultsBoard->find('first', $options);
		}
		$students = $this->ResultsBoard->Student->find('list');
		$this->set(compact('students'));
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ //Important Note : Not Currently Used
/*	public function delete($id = null) {
		$this->ResultsBoard->id = $id;
		if (!$this->ResultsBoard->exists()) {
			throw new NotFoundException(__('Invalid results board'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ResultsBoard->delete()) {
			$this->Session->setFlash(__('The results board has been deleted.'));
		} else {
			$this->Session->setFlash(__('The results board could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
