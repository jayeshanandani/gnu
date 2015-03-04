<?php
App::uses('FeedbackSystemAppController', 'FeedbackSystem.Controller');
/**
 * FeedbackAnswers Controller
 *
 * @property FeedbackAnswer $FeedbackAnswer
 * @property PaginatorComponent $Paginator
 */
class FeedbackEventAnswersController extends FeedbackSystemAppController {

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
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1, 'contain' => ['FeedbackEventQuestion']);
		$this->set('feedbackEventAnswers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeedbackEventAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid feedback answer'));
		}
		$options = array('conditions' => array('FeedbackEventAnswer.' . $this->FeedbackEventAnswer->primaryKey => $feedback_event_question_id));
		$this->set('feedbackEventAnswer', $this->FeedbackEventAnswer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
           if ($this->request->is('post')) {
           	$this->loadModel('Setting');
		    $data = $this->Setting->find('first');
			$this->FeedbackEventAnswer->create();
			$this->request->data['FeedbackEventAnswer']['user_id'] = $this->Auth->user('id');
             if ($this->FeedbackEventAnswer->save($this->request->data,true,array('feedback_event_question_id','answer','creator_id','user_id'))) {
				$this->request->data['FeedbackEventQuestion']['id'] = $this->request->data['FeedbackEventAnswer']['feedback_event_question_id'];
			     $this->request->data['FeedbackEventQuestion']['inform_id'] = 0;
			    if($this->FeedbackEventAnswer->FeedbackEventQuestion->save($this->request->data,true,['id','inform_id','modifier_id'])) {
			    	$this->loadModel('UserRole');
			    	$this->loadModel('User');
			    	$this->request->data['UserRole']['role_id'] = 6;
			    	if($this->UserRole->save($this->request->data)) {
						$this->Session->setFlash(__('The feedback answer has been saved.'), 'default', array('class' => 'alert alert-success'));
			          return $this->redirect(array('action' => 'add'));
					}	
				}
			} else {
				$this->Session->setFlash(__('The feedback answer could not be saved. Please, try again.'));
			}
		}
		unset($this->request->data['FeedbackEventAnswer']['feedback_event_question_id']);
		
     $answers = $this->FeedbackEventAnswer->FeedbackEventQuestion->find('list', 
                              array(
                                    'conditions' => array('FeedbackEventQuestion.inform_id' => 1)
                                   )
                               );

	
		$this->set(compact('answers'));
		
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FeedbackEventAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid feedback answer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FeedbackEventAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback answer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeedbackEventAnswer.' . $this->FeedbackEventAnswer->primaryKey => $id));
			$this->request->data = $this->FeedbackEventAnswer->find('first', $options);
		}
		$createdBies = $this->FeedbackEventAnswer->CreatedBy->find('list');
		$modifiedBies = $this->FeedbackEventAnswer->ModifiedBy->find('list');
		$this->set(compact('createdBies', 'modifiedBies'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FeedbackEventAnswer->id = $id;
		if (!$this->FeedbackEventAnswer->exists()) {
			throw new NotFoundException(__('Invalid feedback answer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FeedbackEventAnswer->delete()) {
			$this->Session->setFlash(__('The feedback answer has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The feedback answer could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function column_feedbacks() {
     	$this->loadModel('FeedbackEventCategory');       
        $categories = $this->FeedbackEventCategory->find('list');
        $feedbacks = [];
        foreach ($categories as $key => $value) {
        	$count = $this->FeedbackEventAnswer->find('count',['conditions'=>['FeedbackEventAnswer.answer'=>$key]]);
        	$feedbacks[$key] = $count;
        }
        
        $data = [];
		$counter = 0;

		foreach($feedbacks as $key=>$value) {
			$data[$counter] = (int)$value;
			$counter++;
		}

		$content = [];
		$counter = 0;

		foreach ($categories as $key => $value) {
			$content[$counter] = $value;
			$counter++;
		}

        $chartName = 'Total Feedbacks';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                                  => 'columnwrapper',
                            'chartWidth'				=> 800,
                            'chartHeight'				=> 500,
                            'title'					=> 'Feedbacks vs Count',
                            'subtitle'                                  => 'Feedback System',
                            'xAxisLabelsEnabled' 			=> FALSE,
                            'xAxisFeedbackCategories'       	=> $content,
                            'yAxisTitleText' 		=> 'Count',
                            'enableAutoStep' 		=> TRUE,
                            'creditsEnabled'		=> FALSE,
                            'chartTheme'                => 'highroller',

                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Total Feedback')->addData($data);

        $mychart->addSeries($series);
    }
}
