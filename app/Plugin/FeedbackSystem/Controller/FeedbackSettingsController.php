<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackSettings Controller
 *
 * @property FeedbackSetting $FeedbackSetting
 * @property PaginatorComponent $Paginator
 */
class FeedbackSettingsController extends FeedbackSystemAppController {

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
	
		$this->set('feedbackSettings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackSetting->exists($id)) {
			throw new NotFoundException(__('Invalid feedback setting'));
		}
		$options = array('conditions' => array('FeedbackSetting.' . $this->FeedbackSetting->primaryKey => $id));
		$this->set('feedbackSetting', $this->FeedbackSetting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FeedbackSetting->create();
			if ($this->FeedbackSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback setting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback setting could not be saved. Please, try again.'));
			}
		}
		$this->loadModel('FeedbackStatus');
		$statuses = $this->FeedbackStatus->find('list',['conditions'=>['FeedbackStatus.recstatus'=>1]]);
		$this->set(compact('statuses'));
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->loadModel('FeedbackStatus');
		if (!$this->FeedbackSetting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['FeedbackSetting']['id'] = $id;
			if ($this->FeedbackSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackSetting.' . $this->FeedbackSetting->primaryKey => $id));
			$this->request->data = $this->FeedbackSetting->find('first', $options);
			$statuses = $this->FeedbackStatus->find('list',['conditions'=>['FeedbackStatus.recstatus'=>1]]);
		    $this->set(compact('statuses'));
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FeedbackSetting->id = $id;
		if (!$this->FeedbackSetting->exists()) {
			throw new NotFoundException(__('Invalid feedback setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FeedbackSetting->delete()) {
			$this->Session->setFlash(__('The feedback setting has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The feedback setting could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
