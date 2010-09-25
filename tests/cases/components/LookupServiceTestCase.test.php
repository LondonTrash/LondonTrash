<?php

class LookupServiceTestCase extends CakeTestCase {
    public function testService() {
        $contents = file_get_contents("http://openhalton.ca/londontrash/LondonTrash.svc/GetZone?address=337%20Ridout%20St.%20South%20London%20Ontario&mapprovider=bing");
        $contents = json_decode($contents);
        // print_r( $contents );
        
        $this->assertEqual(true, isset($contents->d));
    }
}