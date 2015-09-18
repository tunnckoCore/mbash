<?php
/**
 * @file config_model.php
 * @brief Get data from config table
 * @author MartonBash Development
 * @version 1.02d
 * @last update 18 Sep 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Config_Model extends Model {

    public function __construct() {
		parent::__construct();
    }

	public function getConfData() {
		return $this->db->runQuery("SELECT * FROM " . MB_CONFIG);
	}
}
