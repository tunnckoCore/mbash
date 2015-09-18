<?php
/**
 * @file install.php
 * @brief MB Instalation
 * @author MartonBash CMS Development
 * @version 1.2d
 * @last update 30 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Install extends baseController {

	public function __construct() {
		parent::__construct();
	}

	public function step_1() {
				
		if(isset($_POST['finishStepOne'])) {
			$this->MB_SERVER = isset($_POST['MB_SERVER'])? htmlspecialchars(trim($_POST['MB_SERVER'])) : null;
			$this->MB_USERNAME = isset($_POST['MB_USERNAME'])? htmlspecialchars(trim($_POST['MB_USERNAME'])) : null;
			$this->MB_PASSWORD = isset($_POST['MB_PASSWORD'])? htmlspecialchars(trim($_POST['MB_PASSWORD'])) : null;
			$this->MB_DATABASE = isset($_POST['MB_DATABASE'])? htmlspecialchars(trim($_POST['MB_DATABASE'])) : null;
			$this->MB_TABLE_PREFIX = isset($_POST['MB_TABLE_PREFIX'])? htmlspecialchars(trim($_POST['MB_TABLE_PREFIX'])) : null;
			
		
			if($this->MB_SERVER != NULL && $this->MB_USERNAME != NULL && $this->MB_PASSWORD != NULL && $this->MB_DATABASE != NULL) {
			
				if($this->minLen($this->MB_SERVER) != 0 && $this->minLen($this->MB_USERNAME) != 0 && $this->minLen($this->MB_PASSWORD) != 0 && $this->minLen($this->MB_DATABASE) != 0) {
					if(mysql_connect($this->MB_SERVER, $this->MB_USERNAME, $this->MB_PASSWORD)) {
						if(mysql_select_db($this->MB_DATABASE)) {
							if($this->MB_TABLE_PREFIX == NULL) {
								$this->prefix = 'mb_';
							} else {
								$this->prefix = $this->MB_TABLE_PREFIX;
							}
								$this->ready['step1'] = true;
								mysql_close();
								//
								$this->step_2();
								header("Location: step_2");
						} else {
							$this->pubEliteMsgs("Cannoct select database `".$this->MB_DATABASE."` !", "Not connection to database", "step1");
						}
					} else {
						$this->pubEliteMsgs("Cannot connect to server", "Not connection", "step1");
					}
				} else {
					$this->pubEliteMsgs("All fields must be more than 4 characters", "Too short", "step1");
				}
			} else {
				$this->pubEliteMsgs("All * fields are required.", "Empty fields", "step1");
			}
		} else {
			$this->view->load('install/step1');
			$this->view->output(array(
				'TITLE' => 'Step 1 - MySQL Details &bull; MartonBash CMS Installation'
			));
		}
	}
	
	public function step_2() {
		
		// if(isset($_POST['finishStepTwo'])) {
				// $MB_ADMIN_USERNAME = isset($_POST['MB_ADMIN_USERNAME'])? htmlspecialchars(trim($_POST['MB_ADMIN_USERNAME'])) : null;
				// $MB_ADMIN_DISPLAYNAME = isset($_POST['MB_ADMIN_DISPLAYNAME'])? htmlspecialchars(trim($_POST['MB_ADMIN_DISPLAYNAME'])) : null;
				// $MB_ADMIN_PASSWORD = isset($_POST['MB_ADMIN_PASSWORD'])? htmlspecialchars(trim($_POST['MB_ADMIN_PASSWORD'])) : null;
				// $MB_ADMIN_CONFIRM = isset($_POST['MB_ADMIN_CONFIRM'])? htmlspecialchars(trim($_POST['MB_ADMIN_CONFIRM'])) : null;
				// $MB_ADMIN_EMAIL = isset($_POST['MB_ADMIN_EMAIL'])? htmlspecialchars(trim($_POST['MB_ADMIN_EMAIL'])) : null;
				// $MB_ADMIN_HASH = isset($_POST['MB_ADMIN_HASH'])? htmlspecialchars(trim($_POST['MB_ADMIN_HASH'])) : null;
				
				// if($MB_ADMIN_USERNAME != NULL && $MB_ADMIN_DISPLAYNAME != NULL && $MB_ADMIN_PASSWORD != NULL && $MB_ADMIN_CONFIRM != NULL && $MB_ADMIN_EMAIL != NULL) {
					
						// if(filter_var($MB_ADMIN_EMAIL, FILTER_VALIDATE_EMAIL)) {
							// if($MB_ADMIN_PASSWORD == $MB_ADMIN_CONFIRM) {
								// if($this->minLen($MB_ADMIN_USERNAME) != 0 && $this->minLen($MB_ADMIN_DISPLAYNAME) != 0 && $this->minLen($MB_ADMIN_PASSWORD) != 0 && $this->minLen($MB_ADMIN_CONFIRM) != 0 && $this->minLen($MB_ADMIN_EMAIL) != 0) {
								
									// if($this->MB_ADMIN_HASH == "YES") {
										// $this->mb_crypt_password = tds4($MB_ADMIN_PASSWORD, MB_HASH_OWN_KEY, 5, 4, 2010321);
									// } else {
										// $this->mb_crypt_password = md5($MB_ADMIN_PASSWORD);
									// }
										
										// $this->step_3();
										// header("Location: step_3");
								// } else {
									// $this->pubEliteMsgs("All fields must be more than 4 characters", "Too short", "step2");
								// }
							// } else {
								// $this->pubEliteMsgs("Passwords do not match..", "Passwords Not Match", "step2");
							// }
						// } else {
							// $this->pubEliteMsgs("Please fill valid email address.", "Invalid Email", "step2");
						// }
					
				// } else {
					// $this->pubEliteMsgs("All * fields are required.", "Empty fields", "step2");
				// }
			
		// } else {
			// $this->view->load('install/step2');
			// $this->view->output(array(
				// 'TITLE' => 'Step 2 - Admin Settings &bull; MartonBash CMS Installation'
			// ));
		// }
		
		
		
		
		// if(isset($_POST['finishStepTwo'])) {
			// $MB_ADMIN_USERNAME = isset($_POST['MB_ADMIN_USERNAME'])? $_POST['MB_ADMIN_USERNAME'] : null;
			// $MB_ADMIN_DISPLAYNAME = isset($_POST['MB_ADMIN_DISPLAYNAME'])? $_POST['MB_ADMIN_DISPLAYNAME'] : null;
			// $MB_ADMIN_PASSWORD = isset($_POST['MB_ADMIN_PASSWORD'])? $_POST['MB_ADMIN_PASSWORD'] : null;
			// $MB_ADMIN_CONFIRM = isset($_POST['MB_ADMIN_CONFIRM'])? $_POST['MB_ADMIN_CONFIRM'] : null;
			// $MB_ADMIN_EMAIL = isset($_POST['MB_ADMIN_EMAIL'])? $_POST['MB_ADMIN_EMAIL'] : null;
			
		
			// if($this->MB_ADMIN_USERNAME != NULL && $this->MB_ADMIN_DISPLAYNAME != NULL && $this->MB_PASSWORD != NULL && $this->MB_ADMIN_CONFIRM != NULL && $this->MB_ADMIN_EMAIL != NULL) {
			
				// if($this->minLen($this->MB_ADMIN_USERNAME) != 0 && $this->minLen($this->MB_ADMIN_DISPLAYNAME) != 0 && $this->minLen($this->MB_PASSWORD) != 0 && $this->minLen($this->MB_ADMIN_CONFIRM) != 0 && $this->minLen($this->MB_ADMIN_EMAIL) != 0) {
					
						// $this->mb_crypt_password = tds4($this->MB_ADMIN_PASSWORD, MB_HASH_OWN_KEY, 5, 4, 2010321);
					
						// $this->ready['step2'] = true;
						
						// echo "putka";
						
						// $this->step_3();
						// header("Location: step_3");
							
				// } else {
					// $this->pubEliteMsgs("All fields must be more than 4 characters", "Too short", "step1");
				// }
			// } else {
				// $this->pubEliteMsgs("All * fields are required.", "Empty fields", "step1");
			// }
		// } else {
			// $this->view->load('install/step2');
			// $this->view->output(array(
				// 'TITLE' => 'Step 2 - MySQL Details &bull; MartonBash CMS Installation'
			// ));
		// }
		
		
		if(isset($_POST['finishStepTwo'])) {
			$this->MB_SERVER = isset($_POST['MB_SERVER'])? htmlspecialchars(trim($_POST['MB_SERVER'])) : null;
			$this->MB_USERNAME = isset($_POST['MB_USERNAME'])? htmlspecialchars(trim($_POST['MB_USERNAME'])) : null;
			$this->MB_PASSWORD = isset($_POST['MB_PASSWORD'])? htmlspecialchars(trim($_POST['MB_PASSWORD'])) : null;
			$this->MB_DATABASE = isset($_POST['MB_DATABASE'])? htmlspecialchars(trim($_POST['MB_DATABASE'])) : null;
			$this->MB_TABLE_PREFIX = isset($_POST['MB_TABLE_PREFIX'])? htmlspecialchars(trim($_POST['MB_TABLE_PREFIX'])) : null;
			
		
			if($this->MB_SERVER != NULL && $this->MB_USERNAME != NULL && $this->MB_PASSWORD != NULL && $this->MB_DATABASE != NULL) {
			
				if($this->minLen($this->MB_SERVER) != 0 && $this->minLen($this->MB_USERNAME) != 0 && $this->minLen($this->MB_PASSWORD) != 0 && $this->minLen($this->MB_DATABASE) != 0) {
					if(mysql_connect($this->MB_SERVER, $this->MB_USERNAME, $this->MB_PASSWORD)) {
						if(mysql_select_db($this->MB_DATABASE)) {
							if($this->MB_TABLE_PREFIX == NULL) {
								$this->prefix = 'mb_';
							} else {
								$this->prefix = $this->MB_TABLE_PREFIX;
							}
								$this->ready['step2'] = true;
								mysql_close();
								//
								$this->step3();
								header("Location: step_3");
						} else {
							$this->pubEliteMsgs("Cannoct select database `".$this->MB_DATABASE."` !", "Not connection to database", "step2");
						}
					} else {
						$this->pubEliteMsgs("Cannot connect to server", "Not connection", "step2");
					}
				} else {
					$this->pubEliteMsgs("All fields must be more than 4 characters", "Too short", "step2");
				}
			} else {
				$this->pubEliteMsgs("All * fields are required.", "Empty fields", "step2");
			}
		} else {
			$this->view->load('install/step2');
			$this->view->output(array(
				'TITLE' => 'Step 2 - MySQL Details &bull; MartonBash CMS Installation'
			));
		}
	}
	
	public function minLen($value) {
		if(strlen($value) > 4) { return 1; }
		else {
			return 0;
		}
	}
	
	public function error() {
		$this->view->load('install/error');
		$this->view->output(array(
			'TITLE'     => 'Page Not Found'
		));
	}
	
	private function pubEliteMsgs($errMsg, $pageTitle, $step) {
		$this->errors['msg'] = $errMsg;
		$this->view->data[] = $this->errors;
		$steper = substr($step, 0 ,3);
		$this->view->load('install/'.$step);
		$this->view->output(array(
			'TITLE'     => $pageTitle.' - Step '.$steper[2].' - Miscelinious &bull; MartonBash CMS Installation',
		));
	}
}