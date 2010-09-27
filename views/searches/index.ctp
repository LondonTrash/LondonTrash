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

    echo $form->create('Search', array('id' => 'search-box', 'type' => 'post'));
    echo $form->input('address', array('div' => false, 'label' => false, 'class' => 'searchTerm', 'value' => isset($_GET['a']) ? $_GET['a'] : ''));
	echo $form->submit('GO', array('div' => false, 'class' => 'sbutton'));
    echo $form->end();
?>
