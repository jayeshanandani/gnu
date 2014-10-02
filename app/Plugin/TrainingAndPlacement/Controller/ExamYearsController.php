<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ExamYearsController extends TrainingAndPlacementAppController {


/**
 * index method
 *
 * @return void
 *///Important Note : Not Currently Used
/*	public function index() {
		$this->ExamYear->recursive = 0;
		$this->set('examYears', $this->Paginator->paginate());
	}
*/
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 *///Important Note : Not Currently Used
/*	public function view($id = null) {
		if (!$this->ExamYear->exists($id)) {
			throw new NotFoundException(__('Invalid exam year'));
		}
		$options = array('conditions' => array('ExamYear.' . $this->ExamYear->primaryKey => $id));
		$this->set('examYear', $this->ExamYear->find('first', $options));
	}
*/
/**
 * add method
 *
 * @return void
 *///Important Note : Not Currently Used
/*	public function add() {
		if ($this->request->is('post')) {
			$this->ExamYear->create();
			if ($this->ExamYear->save($this->request->data)) {
				$this->Session->setFlash(__('The exam year has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exam year could not be saved. Please, try again.'));
			}
		}
		$academicYears = $this->ExamYear->AcademicYear->find('list');
		$semesters = $this->ExamYear->Semester->find('list');
		$this->set(compact('academicYears', 'semesters'));
	}
*/
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 *///Important Note : Not Currently Used
/*	public function edit($id = null) {
		if (!$this->ExamYear->exists($id)) {
			throw new NotFoundException(__('Invalid exam year'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ExamYear->save($this->request->data)) {
				$this->Session->setFlash(__('The exam year has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exam year could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ExamYear.' . $this->ExamYear->primaryKey => $id));
			$this->request->data = $this->ExamYear->find('first', $options);
		}
		$academicYears = $this->ExamYear->AcademicYear->find('list');
		$semesters = $this->ExamYear->Semester->find('list');
		$this->set(compact('academicYears', 'semesters'));
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 *///Important Note : Not Currently Used
/*	public function delete($id = null) {
		$this->ExamYear->id = $id;
		if (!$this->ExamYear->exists()) {
			throw new NotFoundException(__('Invalid exam year'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ExamYear->delete()) {
			$this->Session->setFlash(__('The exam year has been deleted.'));
		} else {
			$this->Session->setFlash(__('The exam year could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
*/
}
