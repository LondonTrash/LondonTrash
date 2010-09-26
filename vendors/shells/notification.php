<?php

class NotificationShell extends Shell {

    var $uses = array('Subscriber');
    function main() {

        //send out reminder emails
        $this->out("This is your reminder!");

    }
   }
   
?>
