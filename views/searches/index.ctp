<?php    
	echo $this->Form->create('Search', array('id' => 'search-box', 'type' => 'post'));
	echo $this->Form->input('address', array('div' => false, 'label' => false, 'class' => 'searchTerm', 'title' => 'Enter address', 'value' => isset($_GET['a']) ? $_GET['a'] : ''));
	echo $this->Form->submit('GO', array('div' => false, 'class' => 'sbutton'));
	echo $this->Form->end();
?>
