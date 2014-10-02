<?php
App::uses('AppController', 'Controller');
/**
 * ScheduleExams Controller
 *
 * @property ScheduleExam $ScheduleExam
 * @property PaginatorComponent $Paginator
 */
class ScheduleExamsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('scheduleExams', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScheduleExam->exists($id)) {
			throw new NotFoundException(__('Invalid schedule exam'));
		}
		$options = array('conditions' => array('ScheduleExam.' . $this->ScheduleExam->primaryKey => $id));
		$this->set('scheduleExam', $this->ScheduleExam->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScheduleExam->create();
			if ($this->ScheduleExam->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule exam has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule exam could not be saved. Please, try again.'));
			}
		}
		$academicYears = $this->ScheduleExam->AcademicYear->find('list');
		$degrees = $this->ScheduleExam->Degree->find('list');
		$this->set(compact('academicYears', 'degrees'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ScheduleExam->exists($id)) {
			throw new NotFoundException(__('Invalid schedule exam'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ScheduleExam->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule exam has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule exam could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ScheduleExam.' . $this->ScheduleExam->primaryKey => $id));
			$this->request->data = $this->ScheduleExam->find('first', $options);
		}
		$academicYears = $this->ScheduleExam->AcademicYear->find('list');
		$degrees = $this->ScheduleExam->Degree->find('list');
		$this->set(compact('academicYears', 'degrees'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ScheduleExam->id = $id;
		if (!$this->ScheduleExam->exists()) {
			throw new NotFoundException(__('Invalid schedule exam'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ScheduleExam->delete()) {
			$this->Session->setFlash(__('The schedule exam has been deleted.'));
		} else {
			$this->Session->setFlash(__('The schedule exam could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
