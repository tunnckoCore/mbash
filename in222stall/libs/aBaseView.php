<?php
/**
 * @file aBaseView.php
 * @brief Abstract Base View Controller
 * @author MartonBash Development
 * @version 4.24d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

abstract class aBaseView {

	abstract public function __construct($tempDir);
	
	abstract public function load($templateName);
	
	abstract public function endLoad();
   
	abstract public function set($key,$value);
	
    abstract public function render($beginToken,$endToken, $return = true);
	
}

?>