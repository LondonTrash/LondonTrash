<?php
class ProblemReportsController extends AppController {
	var $name = 'ProblemReports';
	
	function add() {
		if (!empty($this->data)) {
			if ($this->ProblemReport->save($this->data)) {
				$this->Session->setFlash("Thanks. We'll look into it.", 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'success'));
			} else {
				$this->Session->setFlash('Sorry, there was an error with your submission. Please try again.');	
			}
		}
	}
	
	function success() {
		// nothing to do here, just render the view
	}
}
?>