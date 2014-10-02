<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class ExamMastersController extends TrainingAndPlacementAppController {

	public function exam_master_form(){
		if ($this->request->is('post') && $this->request->data['ExamMaster']['degree_id']!=0) {
			$institute = $this->request->data['ExamMaster']['institution_id'];
			$department = $this->request->data['ExamMaster']['department_id'];
			$degree = $this->request->data['ExamMaster']['degree_id'];
			return $this->redirect(array('action' => 'index',$institute,$department,$degree));
		}
		unset($this->request->data['ExamMaster']['institution_id']);
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
		$student_list = $this->ExamMaster->Student->find('list', [
			'conditions' => ['Student.institution_id' => $institute,'Student.degree_id' => $degree],
			'fields' => ['Student.id']
		]);
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'contain'=>['Student'=>['conditions'=>['Student.institution_id' => $institute,'Student.degree_id' => $degree]]],
			'conditions' => ['ExamMaster.student_id' => $student_list]
			);
		$this->set('ExamMasters', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ExamMaster->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		$exam_masters = $this->ExamMaster->find('all',['conditions' => ['ExamMaster.student_id' => $id],'contain'=>['ScheduleExam']]);
		$this->set('examMasters', $exam_masters);
	}

	public function display() {
		$exam_masters = $this->ExamMaster->find('all',['conditions' => ['ExamMaster.student_id' => $this->Auth->User('student_id')],'contain' => ['ScheduleExam']]);
		$this->set('examMasters', $exam_masters);
	}


/**
 * add method
 *
 * @return void
 */ // Important Note : Not Currently used
/*	public function add() {
		if ($this->request->is('post')) {
			$this->ExamMaster->create();
			if ($this->ExamMaster->save($this->request->data)) {
				$this->Session->setFlash(__('The exam master has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exam master could not be saved. Please, try again.'));
			}
		}
		$students = $this->ExamMaster->Student->find('list');
		$semesters = $this->ExamMaster->Semester->find('list');
		$examYears = $this->ExamMaster->ExamYear->find('list');
		$this->set(compact('students', 'semesters', 'examYears'));
	}
*/
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ // Important Note : Not Currently used
/*	public function edit($id = null) {
		if (!$this->ExamMaster->exists($id)) {
			throw new NotFoundException(__('Invalid exam master'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ExamMaster->save($this->request->data)) {
				$this->Session->setFlash(__('The exam master has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exam master could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ExamMaster.' . $this->ExamMaster->primaryKey => $id));
			$this->request->data = $this->ExamMaster->find('first', $options);
		}
		$students = $this->ExamMaster->Student->find('list');
		$semesters = $this->ExamMaster->Semester->find('list');
		$examYears = $this->ExamMaster->ExamYear->find('list');
		$this->set(compact('students', 'semesters', 'examYears'));
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ // Important Note : Not Currently used
/*	public function delete($id = null) {
		$this->ExamMaster->id = $id;
		if (!$this->ExamMaster->exists()) {
			throw new NotFoundException(__('Invalid exam master'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ExamMaster->delete()) {
			$this->Session->setFlash(__('The exam master has been deleted.'));
		} else {
			$this->Session->setFlash(__('The exam master could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
