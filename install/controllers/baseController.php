<?php
/**
 * @file baseController.php
 * @brief Base Controller
 * @author MartonBash Development
 * @version 0.2d
 * @last update 13 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class baseController extends aBaseController {

    public function __construct() {
        $this->view = new baseView('template/installation');
    }
}
