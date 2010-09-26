<?php
    
    echo $form->create('Search', array('type' => 'post'));
    echo $form->input('Address');
    echo $form->submit('Go', array('class' => 'sbutton'));
    echo $form->end();
?>
