<?php    

    $this->Html->scriptBlock(
<<<JAVASCRIPT
$(document).ready(function(){
  var address = $("#SearchAddress").val(); 
  if(!address) {
    $("#SearchAddress").css('color', '#999999');
    $("#SearchAddress").val("Enter address");
  }
  $("#SearchAddress").focus(function()
  {
    $("#SearchAddress").css('color', '#000000'); 
    var address = $("#SearchAddress").val(); 
    if(address == "Enter address") { 
      $("#SearchAddress").val(""); 
    }
  }); 

  $("#SearchAddress").blur(function()
  {
    var address = $("#SearchAddress").val(); 
    if(!address) { 
      $("#SearchAddress").css('color', '#999999');
      $("#SearchAddress").val("Enter address"); 
    }
  });
});
JAVASCRIPT
, array('inline' => false)    );

    echo $this->Form->create('Search', array('id' => 'search-box', 'type' => 'post'));
    echo $this->Form->input('address', array('div' => false, 'label' => false, 'class' => 'searchTerm', 'title' => 'Enter address', 'value' => isset($_GET['a']) ? $_GET['a'] : ''));
		echo $this->Form->submit('GO', array('div' => false, 'class' => 'sbutton'));
    echo $this->Form->end();
?>
