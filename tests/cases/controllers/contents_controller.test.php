<?php
/* Contents Test cases generated on: 2010-09-25 17:09:05 : 1285451345*/
App::import('Controller', 'Contents');

class TestContentsController extends ContentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.content');

	function startTest() {
		$this->Contents =& new TestContentsController();
		$this->Contents->constructClasses();
	}

	function endTest() {
		unset($this->Contents);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>