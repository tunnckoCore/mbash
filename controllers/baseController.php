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
		if(!is_dir(MB_INSTALL_DIR)) {
			$this->loadConfig();
			$this->view = new baseView($this->config['TEMPLATE_PATH'].'/'.$this->config['TEMPLATE_NAME']);
		} else {
			$this->view = new installView('template/installation');
		}

    }

    public function loadModel($name) {
		$name = strtolower($name);

		$path = 'models/' . $name . '_model.php';
		$path = strtolower($path);

        if (file_exists($path)) {
            require($path);

            $modelName = $name . '_model';

            $this->model = new $modelName;

        }
    }

	public function loadConfig() {
		require 'models/config_model.php';
		$configMod = new Config_Model;
		$this->config = sqlFetchRow($configMod->getConfData());
	}
}
