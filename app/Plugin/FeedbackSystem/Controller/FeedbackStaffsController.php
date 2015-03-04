<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackStaffs Controller
 *
 */
class FeedbackStaffsController extends FeedbackSystemAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
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
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['Institution','Department']);
		$this->set('feedbackStaffs', $this->Paginator->paginate());

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackStaff->exists($id)) {
			throw new NotFoundException(__('Invalid feedback staff'));
		}
		$options = array('conditions' => array('FeedbackStaff.' . $this->FeedbackStaff->primaryKey => $id),'recursive'=>-1,'contain'=>['Institution','Department']);
		$this->set('feedbackStaff', $this->FeedbackStaff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FeedbackStaff->create();
			if ($this->FeedbackStaff->save($this->request->data,true , array('name','email','phone','city','state','pincode','address','staffstatus','institution_id','department_id'))) {
				$this->Session->setFlash(__('The feedback staff has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback staff could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$institutions = $this->FeedbackStaff->Institution->find('list');
		$departments = $this->FeedbackStaff->Department->find('list');
		$this->set(compact('institutions', 'departments'));
	}
	public function edit($id = null) {
		if (!$this->FeedbackStaff->exists($id)) {
			throw new NotFoundException(__('Invalid feedback staff'));
		}
		$this->request->data['FeedbackStaff']['id'] = $id;
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackStaff->save($this->request->data,true,array('id','name'))) {
				$this->Session->setFlash(__('The feedback staff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback staff could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackStaff.' . $this->FeedbackStaff->primaryKey => $id));
			$this->request->data = $this->FeedbackStaff->find('first', $options);
		}
		

		
	}
	public function list_staff() {
		$this->request->onlyAllow('ajax');
		$id = $this->request->query('id');
		if (!$id) {
			throw new NotFoundException();
		}

		$this->disableCache();

		$feedbackstaffs = $this->FeedbackStaff->getListByDepartment($id);

		$this->set(compact('feedbackstaffs'));
		$this->set('_serialize', array('feedbackstaffs'));
	}


}
