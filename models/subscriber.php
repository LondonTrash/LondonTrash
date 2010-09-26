<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';

	var $belongsTo = array(
		'Provider',
		'Zone'
             	);

        public function add($email, $mobile, $zone)
        {
            //add a subscriber
            echo "THANKS FOR SUBSCRIBING!" . $email . $mobile . $zone;
        }
}
?>