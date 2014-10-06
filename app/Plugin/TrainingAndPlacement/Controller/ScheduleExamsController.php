<?php
App::uses('AppController', 'Controller');

/**
 * ScheduleExams Controller
 *
 */
class ScheduleExamsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	*/
	public $components = ['Paginator'];

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
		$options = ['conditions' => ['ScheduleExam.' . $this->ScheduleExam->primaryKey => $id]];
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
				return $this->redirect(['action' => 'index']);
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
		if ($this->request->is(['post', 'put'])) {
			if ($this->ScheduleExam->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule exam has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Session->setFlash(__('The schedule exam could not be saved. Please, try again.'));
			}
		} else {
			$options = ['conditions' => ['ScheduleExam.' . $this->ScheduleExam->primaryKey => $id]];
			$this->request->data = $this->ScheduleExam->find('first', $options);
		}
		$academicYears = $this->ScheduleExam->AcademicYear->find('list');
		$degrees = $this->ScheduleExam->Degree->find('list');
		$this->set(compact('academicYears', 'degrees'));
	}
}
