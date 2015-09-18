<?php
/**
 * @file Bootstrap.php
 * @brief MartonBash Boostrap working with .htaccess
 * @author MartonBash Development
 * @version 0.17c3
 * @last update 10 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class MB_Install_Bootstrap {
 
        public function __construct() {
			$url = isset($_GET['install']) ? $_GET['install'] : null;
			$url = rtrim($url, '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			$class = isset($url[0]) ? $url[0] : null;
			$method = isset($url[1]) ? $url[1] : null;
			$args = isset($url[2]) ? $url[2] : null;
			if($class != NULL) {
				$file = 'controllers/' . $class . '.php';
			   
				if(file_exists($file)) {
					if(isset($url[1]) && isset($url[2])) {
						require $file;
						$controller = new $class;
						if(method_exists($controller, $url[1])) {
							$controller->{$url[1]}($url[2]);
						} else {
							$controller->error();
						}
					} else {
						if(isset($url[1])) {
							require $file;
							$controller = new $class;
							
							
								if(method_exists($controller, $url[1])) {
									$controller->{$url[1]}();
								} else {
									$controller->error();
								}
							
						}
						
						if(!isset($url[1]) || $url[1] == NULL) {
							require $file;
							if(class_exists($class)) {
								$controller = new $class;
								$controller->index();
							} else {
								if($url[0] == "index" || $url[0] == "index/") {
									require 'controllers/steps.php';
									$controller = new Steps();
									$controller->step_1();
								} else {
									require 'controllers/error_handler.php';
									$controller = new Error_Handler();
									$controller->error();
								}
							}
						}
					}
				} else {
					require 'controllers/error_handler.php';
					$controller = new Error_Handler();
					$controller->error();
				}
			} else {
				require 'controllers/steps.php';
				$controller = new Steps();
				$controller->step_1();
			}
        }
 
		
}
?>