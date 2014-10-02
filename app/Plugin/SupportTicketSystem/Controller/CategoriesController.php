<?php
App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends SupportTicketSystemAppController {

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
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1);
		$this->set('categories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		
		$options = ['conditions' => ['Category.' . $this->Category->primaryKey => $id],'contain'=>['Ticket'=>['Status','Staff','User']]];
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
      		$this->request->data['Category']['name'] = ucfirst(strtolower($this->request->data['Category']['name']));
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->data['Category']['id'] = $id;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data,true,array('id','name'))) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
	}

	public function deactivate($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            if (!$this->Category->exists()) {
                throw new NotFoundException(__('Invalid Category'));
            }
            $this->request->data['Category']['id'] = $id;
            $this->request->data['Category']['recstatus'] = 0;
            if ($this->Category->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The category has been deactivated.'));
            } else {
                $this->Session->setFlash(__('The category cannot be deactivated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    public function activate($id = null) {
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            if (!$this->Category->exists()) {
                throw new NotFoundException(__('Invalid category'));
            }
            $this->request->data['Category']['id'] = $id;
            $this->request->data['Category']['recstatus'] = 1;
            if ($this->Category->save($this->request->data,true,array('id','recstatus'))) {
                $this->Session->setFlash(__('The category has been activated.'));
            } else {
                $this->Session->setFlash(__('The category cannot be activated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
    }

}
