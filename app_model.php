<?php
class AppModel extends Model {
	// if we're scaffolding/baking, we'll want recursive at 1. leave this commented out for now.
	// var $recursive = -1;
	
	var $actsAs = array('Containable');	
}