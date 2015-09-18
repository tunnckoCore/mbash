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

	abstract public function __construct($templatePath);

	abstract public function loadTemplate($templateName, $version);

	abstract protected function setTags($key,$value);

    abstract public function assign($key,$value);

	abstract public function dataSetter($infoArray);

	abstract protected function setUrl($value);

	abstract public function cseSideLoginBox();

	abstract public function cseMenuLinks();

	abstract public function liababyMenuLinks();

	abstract protected function getLoginTime();

	abstract protected function getUserType();

	abstract public function loadLiaSlider();

	abstract public function endLoad();

    abstract public function render($beginToken,$endToken, $return = true);

}
