<?php
/**
 * @file error_handler.php
 * @author MartonBash Development
 * @version 0.3d
 * @last update 09 Sep 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Error_Handler extends baseController {

	public function __construct() {
        parent::__construct();
    }

	public function error() {

		$info = isset($this->config) ? $this->config : null;
		$this->view->dataSetter($info);

		$this->view->loadTemplate('404/index', 2);

		$this->view->assign('TITLE','Грешка 404 - страницата не е намерена - '.$info['TITLE']);
		$this->view->assign('DESC','Страницата, която беше потърсена не може да бъде намерена или не съществува. '.$info['DESC']);
		$this->view->assign('KEYWORDS',$info['KEYWORDS']);

		$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
		$this->view->assign('OG_TYPE','website');
		$this->view->assign('OG_TITLE',$info['TITLE']);

		$this->view->assign('CANONICAL',$info['BASE_URL'].'404.html');
		$this->view->assign('MAIN_PATH',$info['BASE_URL']);

		$this->view->assign('MIDDLE',$this->view->loadLiaSlider());

		$this->view->assign('COPYRIGHT',$info['DOMAIN']);
		$this->view->assign('ROBOTS',$info['ROBOTS']);
		$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
		$this->view->assign('MORE_OPG','');
		$this->view->endLoad();
	}
}
