<?php
class FeedbacksController extends AppController {

	var $name = 'Feedbacks';
	var $helpers = array('Html', 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('add', 'success'));
	}

	function index() {
	}

	function view($id = null) {
		if ($this->isAuthorized())
		{
			$this->Auth->allow(array('admin_login', 'admin_logout'));
			if (!$id) {
				$this->flash(__('Invalid Feedback', true), array('action'=>'index'));
			}
			$this->set('feedback', $this->Feedback->read(null, $id));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Feedback->create();
			if ($this->Feedback->save($this->data)) {
				//$this->flash(__('Feedback saved.', true), array('action'=>'index'));
				//$this->Session->setFlash('Thank you for your feedback', 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'success'));
			} else {
				$this->Session->setFlash('Sorry, there was an error with your feedback. Please try again.');
			}
		}
	}
	
	function success() {
		//display message
	}

	function edit($id = null) {
		$this->Auth->allow(array('admin_login', 'admin_logout'));
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Feedback', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Feedback->save($this->data)) {
				$this->flash(__('The Feedback has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Feedback->read(null, $id);
		}
	}

	function delete($id = null) {
		$this->Auth->allow(array('admin_login', 'admin_logout'));
		if (!$id) {
			$this->flash(__('Invalid Feedback', true), array('action'=>'index'));
		}
		if ($this->Feedback->del($id)) {
			$this->flash(__('Feedback deleted', true), array('action'=>'index'));
		}
	}

}
?>
