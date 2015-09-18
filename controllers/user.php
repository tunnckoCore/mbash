<?php
/**
 * @file user.php
 * @brief Members list, changing password, recover password, login, logout, register user
 * @author MartonBash Development
 * @version 8.15d
 * @last update 13 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class User extends baseController implements iMartonBashControllers {

    public function __construct() {
        parent::__construct();
    }

	/*
		Memeber list load by default
	*/
	public function index() {
		$this->loadModel('user');
        $this->query = $this->model->getUsers(15);

				$info = isset($this->config) ? $this->config : null;
				$this->view->dataSetter($info);

		while ($row = sqlFetchRow($this->query)) {
			$this->dataUser['MAIN_PATH'] = $info['BASE_URL'];
			$this->dataUser['userID'] = $row['userID'];
			$this->dataUser['userUniqueID'] = $row['userUniqueID'];
			$this->dataUser['userNameDisplay'] = $row['userNameDisplay'];
			$this->dataUser['userLogin'] = $row['userLogin'];
			$this->dataUser['userPassword'] = $row['userPassword'];
			$this->dataUser['userEmail'] = $row['userEmail'];
			$this->dataUser['userType'] = $row['userType'];
			$this->dataUser['userLastLogout'] = $row['userLastLogout'];
			if(mysql_num_rows($this->query) == 0) {
				$this->dataUser['noMembers'] = 1;
			}
			$this->view->usersData[] = $this->dataUser;
        }
		$this->view->loadTemplate('user/memberslist', 1);
	}

	public function changePassword() {
		if(Session::getSess('logged') === false) {
            @header('Location: index.php');
        } else {
			$this->loadModel('user');
			if(isset($_POST['changePassword'])) {
				$sessUserName = Session::getSess('userName');
				$oldPass = filterVar($_POST['oldpassword']);
                $newPass = filterVar($_POST['password']);
                $newRepass = filterVar($_POST['repassword']);

				//cannot be empty field
                if(empty($newPass) || empty($newRepass) || empty($oldPass)) {
                    $this->view->loadTemplate('errors/emptyInput', 1);
                } else {
					//get password how is in use from DB.
					$this->getPassQuery = $this->model->getUserData($sessUserName);
					$passRow = sqlFetchRow($this->getPassQuery);
					$oldPassMD = md5($oldPass);

					//if dont match, throw error msg
					if($oldPassMD == $passRow['userPass']) {

						//if newpass not match with old pass, and if match with old - throw error msg
						if(($newPass == $newRepass) && ($oldPass != $newPass)) {

							//must be more than 4 symbols
							if($this->minLen($newPass) !== false && $this->minLen($newRepass) !== false) {

								//check exist session user in db
								$this->checkQuery = $this->model->getUserData($sessUserName);
								if(mysql_num_rows($this->checkQuery) !==  1) {
									$this->view->loadTemplate('errors/invalidUsername', 1);
								} else {
									//if all end good - change password in db.
									$this->query = $this->model->changePass($sessUserName, $newRepass);
									if(!mysql_error()) {
										$this->view->loadTemplate('user/successChangePassword', 1);
									}
								}
							} else {
								$this->view->loadTemplate('errors/shortInput', 1);
							}
						} else {
							$this->view->loadTemplate('errors/donotMatch', 1);
						}
					} else {
						$this->view->loadTemplate('errors/wrongOldpass', 1);
					}
                }
            } else {
                $this->view->loadTemplate('user/changePassword', 1);
            }
        }
	}

	public function recoverPassword() {
		if(Session::getSess('logged') === true) {
            @header('Location: index.php');
        } else {
			$this->loadModel('user');
			$userEmail = $_POST['userEmail'];
			if(isset($_POST['submitRecoverPassword'])) {
				if(!empty($userEmail)) {
					if(validEmail($userEmail)) {
						if($this->minLen($userEmail) !== false) {
							$this->query = $this->model->checkEmail($userEmail);
							if(mysql_num_rows($this->query) !== 1) {
								$this->view->loadTemplate('errors/notExistEmail', 1);
							} else {
								$newPassword = rand(1,1000000);
								$this->query = $this->model->setNewPassword($newPassword, $userEmail);
								if(!mysql_error()) {
									$message = "
										==============(S-MVC2 Mailer)==============\r\n
										===========================================\r\n
										A request for the password for this account has been made.\r\n
										The new password for this account is <b>$newPassword</b> .\r\n
										Please log in and change your password.\r\n
										======================================\r\n\r\n
										Do not replay to this email!\r\n".BLOG_TITLE . NOREPLAY_EMAIL;
									$this->sendEmail = $this->model->sendEmailPassword($userEmail, 'Вашата нова парола', $message);
									if(!mysql_error()) {
										$this->view->loadTemplate('user/successRecoverPassword', 1);
									}
								}
							}
						} else {
							$this->view->loadTemplate('errors/shortInput', 1);
						}
					} else {
						$this->view->loadTemplate('errors/invalidEmail', 1);
					}
				} else {
					$this->view->loadTemplate('errors/emptyInput', 1);
				}
			} else {
				$this->view->loadTemplate('user/recoverPassword', 1);
			}
		}
	}

	/*
		Private preview of user profile
		more info available
	*/
	public function userProfile($userNameDisplay) {
		$userNameDisplay = isset($userNameDisplay) ? tdsEsc($userNameDisplay) : null;
		if($userNameDisplay == NULL) {
			header('Location: ../../index');
		} else {
			$userNameDisplay = str_replace('-', ' ', $userNameDisplay);
			$userNameDisplay = str_replace('.html', '', $userNameDisplay);

			if($userNameDisplay != Session::getSess('userNameDisplay')) {
				header('Location: ../../index');
			} else {
				$this->loadModel('user');

				$info = isset($this->config) ? $this->config : null;
				$this->view->dataSetter($info);

				$this->getNameQuery = $this->model->selectData('userNameDisplay', $userNameDisplay);
				while ($row = sqlFetchRow($this->getNameQuery)) {
					$this->viewUser['MAIN_PATH'] = $info['BASE_URL'];
					$this->viewUser['userUniqueID'] = $row['userUniqueID'];
					$this->viewUser['userNameDisplay'] = $row['userNameDisplay'];
					$this->viewUser['userLogin'] = $row['userLogin'];
					$this->viewUser['userPassword'] = $row['userPassword'];
					$this->viewUser['userEmail'] = $row['userEmail'];
					$this->viewUser['userType'] = $row['userType'];
					$this->viewUser['userLastLogout'] = $row['userLastLogout'];
					if(mysql_num_rows($this->getNameQuery) != 0) {
						$this->viewUser['exist'] = 1;
					}
					$this->view->profileView[] = $this->viewUser;
				}
				$userND = str_replace(' ', '-', $this->viewUser['userNameDisplay']);
				$userND = $userND.'.html';

				$this->view->loadTemplate('user/userProfile', 2);
				$this->view->assign('TITLE','Настройки на '.$this->viewUser['userNameDisplay'].' - '.$info['OG_SITE_NAME']);
				$this->view->assign('DESC','Настройки на потребител '.$this->viewUser['userNameDisplay'].'. Редактиране на потребител '.$this->viewUser['userNameDisplay'].'. '.$info['DESC']);
				$this->view->assign('KEYWORDS','потребителски настройки,потребителски настройки на '.$this->viewUser['userLogin'].','.$this->viewUser['userNameDisplay'].','.$this->viewUser['userNameDisplay'].' profile,'.$info['KEYWORDS']);

				$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
				$this->view->assign('OG_TYPE','website');
				$this->view->assign('OG_TITLE','Профил на '.$this->viewUser['userNameDisplay']);

				$this->view->assign('CANONICAL',$info['BASE_URL'].'user/userProfile/'.$userND);
				$this->view->assign('MAIN_PATH',$info['BASE_URL']);

				$this->view->assign('MIDDLE',$this->view->loadLiaSlider());

				$this->view->assign('COPYRIGHT',$info['DOMAIN']);
				$this->view->assign('ROBOTS',$info['ROBOTS']);
				$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
				$this->view->assign('MORE_OPG','');
				$this->view->endLoad();
			}
		}
	}

	/*
		Public preview of user profile
	*/
	public function viewProfile($userNameDisplay) {
		$userNameDisplay = isset($userNameDisplay) ? tdsEsc($userNameDisplay) : null;
		if($userNameDisplay == NULL) {
			header('Location: ../../index');
		} else {

			$userNameDisplay = str_replace('-', ' ', $userNameDisplay);
			$userNameDisplay = str_replace('.html', '', $userNameDisplay);

			$this->loadModel('user');

			$info = isset($this->config) ? $this->config : null;
			$this->view->dataSetter($info);

			$viewUser = NULL;
			if($viewUser == NULL) {
				$this->getNameQuery = $this->model->selectData('userNameDisplay', $userNameDisplay);
				while ($row = sqlFetchRow($this->getNameQuery)) {
					$viewUser['MAIN_PATH'] = $info['BASE_URL'];
					$viewUser['userLogin'] = $row['userLogin'];
					$viewUser['userNameDisplay'] = $row['userNameDisplay'];
					$viewUser['userEmail'] = $row['userEmail'];
					$viewUser['userType'] = $row['userType'];
					$viewUser['userLastLogout'] = $row['userLastLogout'];
					if(mysql_num_rows($this->getNameQuery) != 0) {
						$viewUser['exist'] = 1;
					}

					$this->view->profileView[] = $viewUser;
				}
				$userND = isset($userND) ? $userND : $userND;
				$userND = str_replace(' ', '-', $viewUser['userNameDisplay']);
				$userND = $userND.'.html';


				$userName = str_replace(' ', '-', $userNameDisplay);
				$userName = $userName.'.html';
				if($userName != $userND) {
					$this->error();
				}

				$this->view->loadTemplate('user/viewProfile', 2);
				$this->view->assign('TITLE','Преглед на потребител '.$viewUser['userNameDisplay'].' - '.$info['TITLE']);
				$this->view->assign('DESC','Преглеждане на потребител '.$viewUser['userNameDisplay'].' и повече информация за него. ');
				$this->view->assign('KEYWORDS','преглед на потребител '.$viewUser['userLogin'].','.$viewUser['userNameDisplay'].',преглеждане на '.$viewUser['userNameDisplay'].','.$info['KEYWORDS']);

				$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
				$this->view->assign('OG_TYPE','website');
				$this->view->assign('OG_TITLE','Профил на '.$viewUser['userNameDisplay']);

				$this->view->assign('CANONICAL',$info['BASE_URL'].'user/viewProfile/'.$userND);
				$this->view->assign('MAIN_PATH',$info['BASE_URL']);

				$this->view->assign('MIDDLE',$this->view->loadLiaSlider());

				$this->view->assign('COPYRIGHT',$info['DOMAIN']);
				$this->view->assign('ROBOTS',$info['ROBOTS']);
				$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
				$this->view->assign('MORE_OPG','');
				$this->view->endLoad();

			}
		}
	}

    public function regUser() {
        if(Session::getSess('logged') == true) {
            header('Location: ../index');
        } else {
            $this->loadModel('user');
			$register = isset($_POST['register']) ? tdsEsc($_POST['register']) : null;

				$info = isset($this->config) ? $this->config : null;
				$this->view->dataSetter($info);

				$this->mainPath['MAIN_PATH'] = $info['BASE_URL'];
				$this->view->data[] = $this->mainPath;

            if($register != NULL) {
				$regLoginName = isset($_POST['regLoginName']) ? tdsEsc($_POST['regLoginName']) : null;
				$regDisplayName = isset($_POST['regDisplayName']) ? tdsEsc($_POST['regDisplayName']) : null;
				$regEmail = isset($_POST['regEmail']) ? tdsEsc($_POST['regEmail']) : null;
				$regPass = isset($_POST['regPass']) ? tdsEsc($_POST['regPass']) : null;
				$regRePass = isset($_POST['regRePass']) ? tdsEsc($_POST['regRePass']) : null;
				$userUID = mt_rand(0,999999);
				/* $userUID = 432565; */
				$userType = BASH_USER_TYPE;

				//cannot be empty field
                if($regDisplayName != NULL && $regLoginName != NULL	&& $regEmail != NULL && $regPass != NULL && $regRePass!= NULL) {
                   	if(filter_var($regEmail, FILTER_VALIDATE_EMAIL)) {

						if($regPass == $regRePass) {

							//must be more than 4 symbols
							if($this->minLen($regDisplayName) != 0
									&& $this->minLen($regLoginName) != 0
									&& $this->minLen($regEmail) != 0
									&& $this->minLen($regPass) != 0
									) {


								$this->checkRegQuery = $this->model->selectData('userLogin', $regLoginName);
								if(mysql_num_rows($this->checkRegQuery) != 1) {
									$row = sqlFetchRow($this->checkRegQuery);
									//check already in use user login and uniqueID

									$this->query = $this->model->setUserData($regDisplayName,
																				 $regLoginName,
																				 $regEmail,
																				 $regRePass,
																				 $userUID,
																				 $userType);
									//if not error , render to success page with whole info.
									if(!mysql_error()) {
										$this->view->loadTemplate('user/successRegister', 1);
									} else {
										 header('Location: ../index');
									}
								} else {
									$this->view->loadTemplate('errors/alreadyInUse', 1);
								}
							} else {
								$this->view->loadTemplate('errors/shortInput', 1);
							}
						} else {
							$this->view->loadTemplate('errors/donotMatch', 1);
						}
                   	} else {
						$this->view->loadTemplate('errors/invalidEmail', 1);
                   	}
                } else {
					$this->view->loadTemplate('errors/emptyInput', 1);
				}
            } else {

				$this->view->loadTemplate('user/register', 2);
				$this->view->assign('TITLE','Регистрация - '.$info['TITLE']);
				$this->view->assign('DESC','Регистрация в системата на '.$info['TITLE']);
				$this->view->assign('KEYWORDS',$info['KEYWORDS']);

				$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
				$this->view->assign('OG_TYPE','website');
				$this->view->assign('OG_TITLE','Регистрация в системата на '.$info['TITLE']);

				$this->view->assign('CANONICAL',$info['BASE_URL'].'user/regUser');
				$this->view->assign('MAIN_PATH',$info['BASE_URL']);

				$this->view->assign('MIDDLE',$this->view->loadLiaSlider());

				$this->view->assign('COPYRIGHT',$info['DOMAIN']);
				$this->view->assign('ROBOTS',$info['ROBOTS']);
				$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
				$this->view->assign('MORE_OPG','');
				$this->view->endLoad();
            }
        }
    }

    public function logIn() {
        if(Session::getSess('logged') == true) {
            header('Location: ../index');
        } else {
            $this->loadModel('user');

				$info = isset($this->config) ? $this->config : null;
				$this->view->dataSetter($info);

				$this->mainPath['MAIN_PATH'] = $info['BASE_URL'];
				$this->view->data[] = $this->mainPath;

            if(isset($_POST['login'])) {
                $userLogin = isset($_POST['userLogin']) ? tdsEsc($_POST['userLogin']) : null;
                $userPass = isset($_POST['userPassword']) ? tdsEsc($_POST['userPassword']) : null;
				$userLogInTime = time();
				//cannot be empty field
                if($userPass != NULL && $userPass != NULL) {

					//must be more than 4 symbols
					if($this->minLen($userLogin) != 0 && $this->minLen($userPass) != 0) {

						//checking password and userLogin
						$this->checkQuery = $this->model->checkLogin($userLogin, $userPass);

						//if all right - set session to TRUE.
						if(mysql_num_rows($this->checkQuery) == 1) {
							Session::setSess('logged', true);
							while ($row = sqlFetchRow($this->checkQuery)) {
								Session::setSess('userID', $row['userID']);
								Session::setSess('userUniqueID', $row['userUniqueID']);
								Session::setSess('userLogin', $row['userLogin']);
								Session::setSess('userEmail', $row['userEmail']);
								Session::setSess('userLastLogout', $row['userLastLogout']);
								Session::setSess('userNameDisplay', $row['userNameDisplay']);
								Session::setSess('userType', $row['userType']);
								Session::setSess('userPassword', $userPass);
								Session::setSess('userLogInTime', $userLogInTime);
							}
							$userNameDisplay = Session::getSess('userNameDisplay');
							$userNameDisplay = str_replace(' ', '-', $userNameDisplay);
							$userNameDisplay = $userNameDisplay.".html";
							header('Location: ../user/userProfile/'.$userNameDisplay);
						} else {
							$this->view->loadTemplate('errors/wrongPass', 1);
						}
					} else {
						$this->view->loadTemplate('errors/shortInput', 1);
					}
                } else {
					$this->view->loadTemplate('errors/emptyInput', 1);
                }
            } else {

				$this->view->loadTemplate('user/login', 2);
				$this->view->assign('TITLE','Потребителски вход - '.$info['TITLE']);
				$this->view->assign('DESC','Потребителски вход в системата на '.$info['TITLE']);
				$this->view->assign('KEYWORDS',$info['KEYWORDS']);

				$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
				$this->view->assign('OG_TYPE','website');
				$this->view->assign('OG_TITLE','Потребителски вход - '.$info['TITLE']);

				$this->view->assign('CANONICAL',$info['BASE_URL'].'user/logIn');
				$this->view->assign('MAIN_PATH',$info['BASE_URL']);

				$this->view->assign('MIDDLE',$this->view->loadLiaSlider());

				$this->view->assign('COPYRIGHT',$info['DOMAIN']);
				$this->view->assign('ROBOTS',$info['ROBOTS']);
				$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
				$this->view->assign('MAIN_PATH',$info['BASE_URL']);
				$this->view->assign('MORE_OPG','');
				$this->view->endLoad();
            }
        }
    }

    public function logOut(){
		if(Session::getSess('logged') == true) {
			$this->loadModel('user');
			$userLogin = Session::getSess('userLogin');
			$logoutTime = time();
			$this->updateLog = $this->model->updateLogTime($userLogin, $logoutTime);

			Session::setSess('logged', false);
			header('Location: ../index');
        }
    }

	public function minLen($value) {
		if(strlen($value) > 4) { return 1; }
		else {
			$this->view->loadTemplate('errors/shortInput', 1);
			return 0;
		}
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
