<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackEventStaffs Controller
 *
 * @property FeedbackEventStaff $FeedbackEventStaff
 * @property PaginatorComponent $Paginator
 */
class FeedbackEventStaffsController extends FeedbackSystemAppController {

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
		$this->FeedbackEventStaff->recursive = 0;
		$this->set('feedbackEventStaffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackEventStaff->exists($id)) {
			throw new NotFoundException(__('Invalid feedback event staff'));
		}
		$options = array('conditions' => array('FeedbackEventStaff.' . $this->FeedbackEventStaff->primaryKey => $id),'recursive'=>-1,'contain'=>['Institution','Department']);
		$this->set('feedbackEventStaff', $this->FeedbackEventStaff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FeedbackEventStaff->create();
			if ($this->FeedbackEventStaff->save($this->request->data,true , array('name','email','phone','city','state','pincode','address','staffstatus','institution_id','department_id'))) {
				$this->Session->setFlash(__('The feedback event staff has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback event staff could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$institutions = $this->FeedbackEventStaff->Institution->find('list');
		$departments = $this->FeedbackEventStaff->Department->find('list');
		$this->set(compact('institutions', 'departments'));
	}

	public function list_staff() {
		$this->request->onlyAllow('ajax');
		$id = $this->request->query('id');
		if (!$id) {
			throw new NotFoundException();
		}

		//$this->disableCache();

		$feedbackeventstaffs = $this->FeedbackEventStaff->getListByDepartment($id);

		$this->set(compact('feedbackeventstaffs'));
		$this->set('_serialize', array('feedbackeventstaffs'));
	}
}
