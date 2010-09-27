<?php

App::import('Lib', 'Zonelookup');

class ZoneLookupTestCase extends CakeTestCase {
    public function testLookup() {
        $o = new ZoneLookup();
        
        $data = $o->get_latlng_by_address("337 Ridout St. London Ontario");
        $this->assertEqual("F", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("N6C 3Z4");
        $this->assertEqual("F", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("36 Adare Crescent, London, ON, Canada");
        $this->assertEqual("F", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("30 Silverbrook Drive London Ontario");
        $this->assertEqual("B", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("N5X 3B3");
        $this->assertEqual("B", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("610 Commissioners St. East London Ontario");
        $this->assertEqual("E", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("612 Commissioners St. East London Ontario");
        $this->assertEqual("E", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("1183 Highbury Ave N, London Ontario");
        $this->assertEqual("D", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("366 Dundas St. London Ontario");
        $this->assertEqual("CORE", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("70 Outer Dr, London ON");
        $this->assertEqual("F", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("76 Boardway Ave, London Ontario");
        $this->assertEqual("F", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
        
        $data = $o->get_latlng_by_address("6402 Hamlyn St. London Ontario");
        $this->assertEqual("D", $o->get_zone_by_latlng($data[0]->geometry->location->lat, $data[0]->geometry->location->lng));
    }
}