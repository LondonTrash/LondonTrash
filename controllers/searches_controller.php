<?php
class SearchesController extends AppController {
    
	var $uses = array('Zone');
	
	/**
	 * Clear stored address and zone and redirect to search page
	 *
	 * @param string $address 
	 * @return void
	 * @author Scott Reeves
	 */
	public function clear($address = null) {
		$this->Session->destroy();
		$this->Cookie->delete('address');
		$this->Cookie->delete('zone');
		$this->redirect(array('action' => 'index', '?' => array('a' => $address)));
	}
	
	/**
	 * Used with ambiguous addresses
	 * Updates the user data and redirects to the proper schedule
	 *
	 * @param string $address 
	 * @param string $zone 
	 * @return void
	 * @author Scott Reeves
	 */
	public function choose($address, $zone) {
		if (!empty($address) && !empty($zone)) {
			// clear the ambiguities from the session
			$this->Session->delete('addressChoices');
			
			$this->updateUserData($address, $zone);
			$this->redirect(array('controller' => 'zones', 'action' => 'view', $zone));
		}
		$this->Session->setFlash('Sorry! Please try your search again.');
		$this->redirect(array('action' => 'index'));
	}

	public function index($address = null) {		
		if (empty($this->data) && empty($address) && empty($this->params['url']['a'])) {
			// try to send to result stored in session
			$this->getCookieData(true);
		}
		
		if ($this->data || !empty($address)) {
			if ($this->data) {
				$address = $this->data['Search']['address'];
			}
			$this->doSearch($address);
		}
		$this->set('title_for_layout', false);
	}

	private function doSearch($address = null) {

		// clear any ambiguous address we have in the session
		$this->Session->delete('addressChoices');
		
		// Check to make sure they've entered an address before we do a lookup
		$rawSearchAddress = trim($address);

		if ($rawSearchAddress == 'Enter address' || empty($rawSearchAddress)) {
			$this->Session->setFlash("Please enter an address in the search box.");
			$this->redirect(array('action' => 'index'));
		}
		
		// Check to see if they've entered at least an alpha char.
		// Looking up just numbers on google returns odd results.
		/*
			TODO: This sort of validation really needs to be moved to the model!
			* We can use the $validate property of the model class
		*/
		if (!preg_match('/[a-zA-Z]+/', $address)) {
			$this->Session->setFlash('That does not appear to be a proper address. Please try again.');
			$this->redirect(array('action' => 'index'));
		}
		
		$searchAddress = ucwords($address);
		$zone = $this->Zone->get_zone($searchAddress);
	
		// Try to get a result first before adding London ON, etc. to the end (below)
		$zone_name = null;
		if( isset($zone[0]) ) {
			$zone_name = $zone[0]->zone_name;
			$searchAddress = $zone[0]->address;
		}
	
		if( !$zone_name ) {
			//if zone is empty, try to append city
			$zone_name = null;
			$cities = array('London', 'Byron', 'Lambeth', 'Hyde Park');
		
			foreach($cities as $city) {
				if (empty($zone)) {
					$specificSearchAddress = $searchAddress . ', ' . $city . ', ON';
					$zone = $this->Zone->get_zone($specificSearchAddress);
		
					$zone_name = null;
					if( isset($zone[0]) ) {
						$zone_name = $zone[0]->zone_name;
						$searchAddress = $zone[0]->address;
			
						break;
					}
				}
			}
		
		}
	
		if ($this->Zone->are_results_ambiguous()) {
			// pass array to view so we can display it there
			$this->Session->write('addressChoices', $zone);

			// redirect them back to search page with their search filled in
			$this->redirect(array('action' => 'index', '?' => array('a' => $rawSearchAddress)));
		}
          
		if(!empty($zone_name)) {
			$this->updateUserData($searchAddress, $zone_name);
			$this->redirect(array("controller" => "zones", "action" => "view", $zone_name));
		} else {
			$this->Session->setFlash("Your address was not found. Please verify that you have typed it correctly and search again.");
		}			
	}
	
}

?>