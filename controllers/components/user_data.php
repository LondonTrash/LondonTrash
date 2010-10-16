<?php
class UserDataComponent extends Object {
	var $name = 'UserData';
	
	var $components = array('Session', 'Cookie');
	
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
	}
	
	/**
	 * Update session and long-term cookie
	 *
	 * @param string $address 
	 * @param string $zone 
	 * @return void
	 * @author Scott Reeves
	 */
	public function write($address, $zone) {
		$this->Session->write('address', $address);
		$this->Session->write('zone', $zone);
		$this->Cookie->write('address', $address, null, '10 years');
		$this->Cookie->write('zone', $zone, null, '10 years');
	}
	
	/**
	 * Grab data from long-term cookie, use it to update session and cookie,
	 * and optionally redirect.
	 *
	 * @param bool $redirect 
	 * @return void
	 * @author Scott Reeves
	 */
	public function refresh($redirect = false) {
		$address = null;
		if ($zone = $this->Cookie->read('zone')) {
			$address = $this->Cookie->read('address');
			$this->write($address, $zone);
			if ($redirect === true) {
				$this->controller->redirect(array('controller' => 'zones', 'action' => 'view', $zone));
			}
		}
	}
}
?>