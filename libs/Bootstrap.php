<?php
/**
 * @file Bootstrap.php
 * @brief MartonBash Boostrap working with .htaccess
 * @author MartonBash CMS Development
 * @version 0.18
 * @last update 01 Nov 2012 / 6:40h
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class MB_Bootstrap {

        public function __construct() {
			$url = isset($_GET['url']) ? $_GET['url'] : null;
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
						if(is_dir(MB_INSTALL_DIR)) {
							$controller = new Install;
						} else {
							$controller = new $class;
						}

						if(method_exists($controller, $url[1])) {
							if(is_dir(MB_INSTALL_DIR)) {
								$controller->step_1();
							} else {
								$controller->{$url[1]}($url[2]);
							}

						} else {
							if(is_dir(MB_INSTALL_DIR)) {
								$controller->step_1();
							} else {
								$controller->error();
							}
						}
					} else {
						if(isset($url[1])) {
							require $file;
							if(is_dir(MB_INSTALL_DIR)) {
								$controller = new Install;
							} else {
								$controller = new $class;
							}


								if(method_exists($controller, $url[1])) {
									if(is_dir(MB_INSTALL_DIR)) {
										$controller->step_1();
									} else {
										$controller->{$url[1]}();
									}

								} else {
									if(is_dir(MB_INSTALL_DIR)) {
										$controller->step_1();
									} else {
										$controller->error();
									}

								}

						}

						if(!isset($url[1]) || $url[1] == NULL) {
							require $file;
							if(class_exists($class)) {
								if(is_dir(MB_INSTALL_DIR)) {
									$controller = new Install;
									$controller->step_1();
								} else {
									$controller = new $class;
									$controller->index();
								}

							} else {
								if($url[0] == "index" || $url[0] == "index/") {
									require 'controllers/home.php';
									$controller = new Home();
									$controller->index();
								} else {
									if(is_dir(MB_INSTALL_DIR)) {
										require 'controllers/install.php';
										$controller = new Install;
										$controller->step_1();
									} else {
										require 'controllers/error_handler.php';
										$controller = new Error_Handler();
										$controller->error();
									}
								}
							}
						}
					}
				} else {
					if(is_dir(MB_INSTALL_DIR)) {
						require 'controllers/install.php';
						$controller = new Install;
						$controller->step_1();
					} else {
						require 'controllers/error_handler.php';
						$controller = new Error_Handler();
						$controller->error();
					}
				}
			} else {

				if(is_dir(MB_INSTALL_DIR)) {
					require 'controllers/install.php';
					$controller = new Install;
					$controller->step_1();
				} else {
					require 'controllers/home.php';
					$controller = new Home();
					$controller->index();
				}
			}
        }


}
