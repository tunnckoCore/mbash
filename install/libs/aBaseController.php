<?php
/**
 * @file aBaseController.php
 * @brief Abstract base Controller
 * @author MartonBash Development
 * @version 0.2d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

abstract class aBaseController {

    abstract public function __construct();

}
