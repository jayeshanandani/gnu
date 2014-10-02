<?php
App::uses('AppController', 'Controller');
/**
 * Degrees Controller
 *
 * @property Degree $Degree
 * @property PaginatorComponent $Paginator
 */
class DegreesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Degree->recursive = 0;
		$this->set('degrees', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Degree->exists($id)) {
			throw new NotFoundException(__('Invalid degree'));
		}
		$options = array('conditions' => array('Degree.' . $this->Degree->primaryKey => $id));
		$this->set('degree', $this->Degree->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Degree->create();
			if ($this->Degree->save($this->request->data)) {
				$this->Session->setFlash(__('The degree has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The degree could not be saved. Please, try again.'));
			}
		}
		$departments = $this->Degree->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Degree->exists($id)) {
			throw new NotFoundException(__('Invalid degree'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Degree->save($this->request->data)) {
				$this->Session->setFlash(__('The degree has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The degree could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Degree.' . $this->Degree->primaryKey => $id));
			$this->request->data = $this->Degree->find('first', $options);
		}
		$departments = $this->Degree->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Degree->id = $id;
		if (!$this->Degree->exists()) {
			throw new NotFoundException(__('Invalid degree'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Degree->delete()) {
			$this->Session->setFlash(__('The degree has been deleted.'));
		} else {
			$this->Session->setFlash(__('The degree could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function list_degrees() {
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        if (!$id) {
          throw new NotFoundException();
        }
	  	  $this->disableCache();
		   $degrees = $this->Degree->getListByDepartment($id);

        $this->set(compact('degrees'));
        $this->set('_serialize', array('degrees'));
    }

}
