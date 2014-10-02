<?php
App::uses('TrainingAndPlacementAppController', 'TrainingAndPlacement.Controller');

class StudentResumesController extends AppController {

public function import() {
		if ($this->request->is('post')) {
          	
          	$filename = 'C:\Apache24\htdocs\cakephp\app\tmp\uploads\StudentResume\\'.$this->data['StudentResume']['file']['name']; 
          	$file = $this->data['StudentResume']['file']['name'];
          	$extension = pathinfo($file, PATHINFO_EXTENSION);
        	if($extension == 'csv'){
        	    if (move_uploaded_file($this->data['StudentResume']['file']['tmp_name'],$filename)) {
            	$messages = $this->StudentResume->import($this->data['StudentResume']['file']['name']);
            	/* save message to session */
            	$this->Session->setFlash('File uploaded successfuly. You can view it <a href="C:\Apache24\htdocs\cakephp\app\tmp\uploads\StudentResume\\'.$this->data['StudentResume']['file']['name'].'">here</a>.');
            	/* redirect */
            	$this->redirect(array('action' => 'index'));
        		}
        		else {
            	/* save message to session */
            	$this->Session->setFlash('There was a problem uploading file. Please try again.');
        		}
     		}
     		else{
     			$this->Session->setFlash("Extension error");
     		}
     	}
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->StudentResume->Student->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		
		$student_id = $id;
		$this->loadModel('Institution');
		$this->loadModel('Department');
		$this->loadModel('Degree');
		$this->loadModel('User');

		$email = $this->User->find('all',['conditions' => ['User.student_id' => $student_id],'fields' => ['User.email']]);
		$this->set('email',$email);

		$institution_id = $this->StudentResume->Student->find('list',[
			'conditions' => ['Student.id' => $student_id],
			'fields' => ['Student.institution_id']
			]);
		$degree_id = $this->StudentResume->Student->find('list',[
			'conditions' => ['Student.id' => $student_id],
			'fields' => ['Student.degree_id']
			]);
		$institute = $this->Institution->find('all',[
			'conditions' => ['Institution.id' => $institution_id],
			'fields' => ['Institution.name']
		]);
		$degree = $this->Degree->find('all',[
			'conditions' => ['Degree.id' => $degree_id],
			'fields' => ['Degree.name']
		]);
		$department_id = $this->Degree->find('list',[
			'conditions' => ['Degree.id' => $degree_id],
			'fields' => ['Degree.department_id']
		]);
		$department = $this->Department->find('all',[
			'conditions' => ['Department.id' => $department_id],
			'fields' => ['Department.name']
		]);

		$this->set('institute',$institute);
		$this->set('department',$department);
		$this->set('degree',$degree);

		$student_details = $this->StudentResume->Student->find('all',[
			'conditions' => ['Student.id' => $student_id],
			'fields' => ['Student.firstname','Student.lastname','Student.institution_id','Student.degree_id']
			]);

	//To get 10th n 12th results	
		$this->loadModel('ResultsBoard');
		$resultsBoards = $this->ResultsBoard->find('all',['conditions' => ['ResultsBoard.student_id' => $student_id]]);
		$this->set('resultsBoards', $resultsBoards);

	//To get degree results semester vis	
		$this->loadModel('ExamMaster');
		$this->loadModel('ScheduleExam');
		$sem_ids = $this->ExamMaster->find('list',[
			'conditions' => ['ExamMaster.student_id' => $student_id], 
			'fields' => ['ExamMaster.schedule_exam_id']]);
		$semesters = $this->ScheduleExam->find('all',[
			'conditions' => ['ScheduleExam.id' => $sem_ids],
			'fields' => ['ScheduleExam.session_no']
			]);
		$sgpas = $this->ExamMaster->find('all',[
			'conditions' => ['ExamMaster.student_id' => $student_id, 'ExamMaster.schedule_exam_id' => $sem_ids], 
			'fields' => ['ExamMaster.sgpa']]);
		
		$this->set('semesters',$semesters);
		$this->set('sgpas',$sgpas);


	//To get display student's resume	
		$student_resumes = $this->StudentResume->find('all',[
			'conditions' => ['StudentResume.student_id' => $student_id],'contain'=>['Student']	
			]);
		$this->set('student_resumes', $student_resumes);
		$this->set('student_details', $student_details);			
		
		$this->pdfConfig = array(
                'orientation' => 'portrait',
                'filename' => 'Resume_' . $id
            );

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->StudentResume->create();
			$this->request->data['StudentResume']['student_id']= $this->Auth->user('student_id');
			if ($this->StudentResume->save($this->request->data)) {
				$this->Session->setFlash('The Resume has been saved.');
				return $this->redirect(array('action' => 'view',$this->Auth->user('student_id')));
			} else {
				$this->Session->setFlash(__('The Resume could not be saved or already saved before'));
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
		if (!$this->StudentResume->exists($id)) {
			throw new NotFoundException(__('Invalid student resume'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['StudentResume']['id'] = $id;
			if ($this->StudentResume->save($this->request->data,true,array('id','modifier_id','student_id','careerobjective','hobbies','strengths','os','techlanguages','db','webtechnologies','sw_prog_tools','interestedin','activities','projectname'))) {
				$this->Session->setFlash(__('The Resume has been saved.'));
				return $this->redirect(array('action' => 'view',$this->Auth->user('student_id')));
			} else {
				$this->Session->setFlash(__('The Resume could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('StudentResume.' . $this->StudentResume->primaryKey => $id));
			$this->request->data = $this->StudentResume->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->StudentResume->id = $id;
		if (!$this->StudentResume->exists()) {
			throw new NotFoundException(__('Invalid stu resume'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StudentResume->delete()) {
			$this->Session->setFlash(__('The stu resume has been deleted.'));
		} else {
			$this->Session->setFlash(__('The stu resume could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
