<?php

App::import('Lib', 'Zonelookup');

class ZoneLookupTestCase extends CakeTestCase {

	/**
	 *
	 * @var ZoneLookup
	 */
	protected $object;

	public function startCase() {
		$this->object = new ZoneLookup();
	}

	public function endCase() {
		$this->object = null;
	}

	public function testLookupByAddress() {
		$data = $this->object->get_latlng_by_address("337 Ridout St. London Ontario");
		$this->assertIsA($data[0], 'StdClass', 'Should be a standard object');
		$data = $data[0];
		$this->assertEqual('337 Ridout St S, London, ON N6C 3Z4, Canada', $data->formatted_address, 'Should return the proper address');
		//the street should not move...
		$this->assertEqual('42.963463', $data->geometry->location->lat, 'Should tell us the latitude');
		$this->assertEqual('-81.244292', $data->geometry->location->lng, 'should tell us the longitude');
	}

	public function testLookupByPostalCode() {
		$data = $this->object->get_latlng_by_address('N6C 3Z4');
		$data = $data[0];
		$this->assertEqual('London, ON N6C 3Z4, Canada', $data->formatted_address, 'Should return the proper address');
		//the street should not move...
		$this->assertEqual('42.9636749', $data->geometry->location->lat, 'Should tell us the latitude');
		$this->assertEqual('-81.2445692', $data->geometry->location->lng, 'should tell us the longitude');
	}

	public function testAmbiguousAddresses() {
		$data = $this->object->get_latlng_by_address('Wellington Rd');
		$this->assertEqual(count($data), 10);

		$data = $this->object->get_latlng_by_address('Wellington St');
		$this->assertEqual(10, count($data));

		$data = $this->object->get_latlng_by_address('Wellington Cres');
		$this->assertEqual(10, count($data));

//		$data = $this->object->get_latlng_by_address('Westbury');
//		$this->assertEqual(10, count($data));
	}

	public function testLookupInvalidAddress() {
		$data = $this->object->get_latlng_by_address('Z1Z 1Z1');
		$this->assertFalse($data);

		$data = $this->object->get_latlng_by_address(NULL);
		$this->assertFalse($data);

		$data = $this->object->get_latlng_by_address('');
		$this->assertFalse($data);

		//should do some smart filtering of the data here
		$data = $this->object->get_latlng_by_address(-1);
		$this->assertFalse($data);
	}

	public function testLookupAddresses() {

		$data = $this->object->get_latlng_by_address("337 Ridout St. London Ontario");
		$this->assertEqual("F", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("N6C 3Z4");
		$this->assertEqual("F", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("36 Adare Crescent, London, ON, Canada");
		$this->assertEqual("F", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("30 Silverbrook Drive London Ontario");
		$this->assertEqual("B", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("N5X 3B3");
		$this->assertEqual("B", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("610 Commissioners St. East London Ontario");
		$this->assertEqual("E", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("612 Commissioners St. East London Ontario");
		$this->assertEqual("E", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("1183 Highbury Ave N, London Ontario");
		$this->assertEqual("D", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("366 Dundas St. London Ontario");
		$zone = $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng);
		$this->assertEqual("DTE", $zone);

		$data = $this->object->get_latlng_by_address("70 Outer Dr, London ON");
		$this->assertEqual("F", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("76 Boardway Ave, London Ontario");
		$this->assertEqual("F", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));

		$data = $this->object->get_latlng_by_address("6402 Hamlyn St. London Ontario");
		$this->assertEqual("D", $this->object->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
	}

}