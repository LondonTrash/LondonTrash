<?php    
    echo $form->create('Search', array('id' => 'search-box', 'type' => 'post'));
    echo $form->input('Address', array('div' => false, 'label' => false, 'class' => 'searchTerm'));
		echo $form->submit('GO', array('div' => false, 'class' => 'sbutton'));
    echo $form->end();
?>