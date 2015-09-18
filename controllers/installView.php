<?php
/**
 * @file installView.php
 * @brief Base View router
 * @author MartonBash CMS Development
 * @version 1.4d
 * @last update 30 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class installView {

	private $_template,
			$_vars,
			$_templateHeader,
			$_templateContent,
			$_templateFooter;

	public $_templatePath;

	public function __construct($tempDir) {
		$this->_templatePath = $tempDir;
		$this->_templateHeader = $this->_templatePath."/header.tpl.php";
		$this->_templateFooter = $this->_templatePath."/footer.tpl.php";
	}

	public function output(array $tags = null) {
		if($tags != NULL) {
			foreach($tags as $key => $value) {
				$this->set($key,$value);
			}
		}
		$this->endLoad();
	}

	public function load($templateName) {
		$this->_templateContent = $this->_templatePath.'/'.$templateName .'.php';

			$this->_template = file_get_contents($this->_templateHeader);

	}

	public function endLoad() {
		// $this->set('BASE_PATH',$this->_templatePath.'/assets');

		$this->set('LOGOLINK','');

		$this->render('<?# ',' ?>');
		if(is_readable($this->_templateContent)) require $this->_templateContent;
		if(is_readable($this->_templateFooter)) require $this->_templateFooter;
	}

	public function set($key,$value)
	{
		if (!isset($key) && isset($value)) return;  // Assigning value to non-existing key
		$this->_vars[$key] = $value;
	}

	public function render($beginToken,$endToken, $return = true)
    {
        foreach ($this->_vars as $key => $value)
        {
            $this->_template = str_replace($beginToken . $key . $endToken, $value, $this->_template);
        }
		echo $this->_template;
    }

}
