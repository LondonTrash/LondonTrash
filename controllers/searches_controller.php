<?php
class SearchesController extends Controller {
    
    var $uses = array('Zone');

    public function index()
    {
        if($this->data)
        {
            $zone = $this->Zone->get_zone($this->data['Search']['Address']);
            if(!empty($zone))
            {
                $this->redirect(array("controller"=>"zones", "action"=>"view", $zone));
            }
            else
            {
                $this->Session->setFlash("You FAIL!!!!");
            }
        }
        
    }


};

?>