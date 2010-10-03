<?php
class UpdateSignupsController extends AppController {
	var $name = 'UpdateSignups';
	
	function add() {
		/*
			TODO: Possibly add error checking
		*/
		// grab data from AJAX and save to DB
		if (!empty($this->data['UpdateSignup']['email'])) {
			$this->UpdateSignup->save($this->data);
		}
	}
}
?>