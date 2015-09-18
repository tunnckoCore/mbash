<?php
/**
 * @file Model.php
 * @brief Main Model
 * @author MartonBash Development
 * @version 0.1d
 * @last update 14 Aug 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Model {

    public function __construct() {
        $this->db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
	
}