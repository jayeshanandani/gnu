<?php
App::uses('AppController', 'TrainingAndPlacement.Controller');

class StudentsController extends TrainingAndPlacementAppController {

public $helpers = array('Js');
/**
 * index method
 *
 * @return void
 */
	public function index() {
	
		$this->set('students', $this->Paginator->paginate());
	}
	public function profile_form()
	{
		if ($this->request->is('post') && $this->request->data['Student']['degree_id']!=0) {		
			$institute = $this->request->data['Student']['institution_id'];
			$department = $this->request->data['Student']['department_id'];
			$degree = $this->request->data['Student']['degree_id'];
			return $this->redirect(['action' => 'profile_home', $institute, $department, $degree]);
		}	
		unset($this->request->data['Student']['institution_id']);
		$institutions = $this->Student->Institution->find('list');
		$departments = array();
		$degrees = array();
		$this->set(compact('institutions', 'departments', 'degrees'));				
	}
	public function profile_home($institute = null, $department = null, $degree = null) {
 		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,
			'conditions'=>['Student.institution_id' => $institute, 'Student.degree_id' => $degree]);
		$this->set('Students', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Student->exists($id)) {
			throw new NotFoundException(__('Invalid student'));
		}
		$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
		$this->set('student', $this->Student->find('first', $options));
	
		$this->loadModel('Department');
		$this->loadModel('User');
	
		$institute_id = $this->Student->find('list', ['fields' => ['Student.institution_id']]);
		$institutions = $this->Student->Institution->find('list', ['conditions' => ['Institution.id' => $institute_id]]);
		$this->set('institutions', $institutions);
	
		$email = $this->User->find('list',[
			'conditions' => ['User.student_id' => $id],
			'fields' => ['User.email']
			]);
		$this->set('email', $email);
	
		$degree_id = $this->Student->find('list', [
			'conditions' => ['Student.id' => $id],
			'fields' => ['Student.degree_id']
		]);
		$degrees = $this->Student->Degree->find('list', ['conditions' => ['Degree.id' => $degree_id]]);
		$this->set('degrees', $degrees);

		$department = $this->Student->Degree->find('list',[
			'conditions' => ['Degree.id' => $degree_id],
			'fields' => ['Degree.department_id']
		]);
		$department_name = $this->Department->find('list',[
			'conditions' => ['Department.id' => $department],
			'fields' => ['Department.name']
		]);
		$this->set('department_name', $department_name);
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Student->create();
			if ($this->Student->save($this->request->data)) {
				$this->Session->setFlash('The student has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ //Important Note : Not currently used
/*	public function edit($id = null) {
		if (!$this->Student->exists($id)) {
			throw new NotFoundException(__('Invalid student'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Student']['id']=$id;
			if ($this->Student->save($this->request->data,true,array('firstname','lastname','email','phone1','phone2','C_Address-1','C_Address-2','C_Address-2','C_City','C_State','C_Pincode','P_Address-1','P_Address-2','P_Address-2','P_City','P_State','P_Pincode'))) {
				$this->Session->setFlash(__('The student has been saved.'));
				return $this->redirect(array('action' => 'view',1));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
			$this->request->data = $this->Student->find('first', $options);
		}
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */ //Important Note : Not currently used
/*	public function delete($id = null) {
		$this->Student->id = $id;
		if (!$this->Student->exists()) {
			throw new NotFoundException(__('Invalid student'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Student->delete()) {
			$this->Session->setFlash(__('The student has been deleted.'));
		} else {
			$this->Session->setFlash(__('The student could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
*/
public function chained_dropdowns() {
        $institutions = $this->Controller->Istitution->getList();
        $departments = array();
        foreach ($institutions as $key => $value) {
            $departments = $this->Controller->departments->getListByInstitution($key);
            break;
        }
        $this->set(compact('institutions', 'departments'));
    }

public function country_provinces_ajax() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        if (!$id) {
            throw new NotFoundException();
        }
        $this->viewClass = 'Tools.Ajax';
        $this->loadModel('Data.Deparment');
        $departments = $this->departments->getListByInstitution($id);
        $this->set(compact('institutions'));
    }
}
