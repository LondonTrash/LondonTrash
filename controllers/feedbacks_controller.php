<?php
class FeedbacksController extends AppController {

	var $name = 'Feedbacks';

	function add() {
		if (!empty($this->data)) {
			$this->Feedback->create();
			if ($this->Feedback->save($this->data)) {
				$this->redirect(array('action' => 'success'));
			} else {
				$this->Session->setFlash('Sorry, there was an error with your feedback. Please try again.');
			}
		}
	}
	
	function success() {
		//display message
	}

}
?>