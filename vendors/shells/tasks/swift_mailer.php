<?php // File -> app/vendors/shells/tasks/swift_mailer.php 

App::import('Core', 'Controller'); 
App::import('Component', 'SwiftMailer'); 

class SwiftMailerTask extends Shell { 
    /** 
     * Instance of controller to handle email views 
     *  
     * @var Object 
     * @access Private 
     */ 
    var $__controller = null; 
    /** 
     * Instance of SwiftMailer component 
     *  
     * @var Object 
     * @access Public 
     */ 
    var $instance = null; 

    /** 
     * Initializes this task 
     *  
     * @access Public 
     */ 
    function initialize() { 
        $this->__controller = new Controller(); 
        $this->instance = new SwiftMailerComponent(null); 
        $this->instance->initialize($this->__controller); 
    } 

    /** 
     * Pass parameter to the email view as usual 
     *  
     * @param String $name - parameter name 
     * @param Mixed $data - mixed parameter 
     * @return void 
     * @access public 
     */ 
    function set($name, $data) { 
        $this->__controller->set($name, $data); 
    } 
} 
?>