<?php
class SubscribersController extends AppController {
	var $name = "Subscribers";

        public function add($email, $mobile, $zone)
        {
            //add a subscriber
            echo "THANKS FOR SUBSCRIBING!" . $email . $mobile . $zone;
        }
}
?>