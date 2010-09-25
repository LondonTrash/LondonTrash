<?php

class ContentController extends AppController
{
	function view($id = NULL){
		$this->set('content', $this->Content->read(NULL, $id));
	}
}