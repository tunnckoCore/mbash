<?php
/**
 * @file error_handler.php
 * @author MartonBash Development
 * @version 0.3d
 * @last update 13 Sep 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Error_Handler extends baseController {

	public function __construct() {
        parent::__construct();
    }
	
	public function error() {
		$this->view->load('install/error');
		$this->view->output(array(
			'TITLE'     => 'Page Not Found'
		));
	}
}

?>