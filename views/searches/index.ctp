<?php    
    echo $form->create('Search', array('id' => 'search-box', 'type' => 'post'));
    echo $form->input('Address', array('div' => false, 'label' => false, 'class' => 'searchTerm', 'value' => isset($_GET['a']) ? $_GET['a'] : ''));
	echo $form->submit('GO', array('div' => false, 'class' => 'sbutton'));
    echo $form->end();
?>