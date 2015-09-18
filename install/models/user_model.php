<?php
/**
 * @file user_model.php
 * @brief Get total users, register user, get random unique id, change password, send email with new password, etc..
 * @author MartonBash Development
 * @version 1.02d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class User_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserData($userLogin) {
        return $this->db->runQuery('SELECT * FROM ' . MB_USERS . ' WHERE userID = "' . $userLogin . '"');
    }
	
	public function updateLogTime($userLogin, $userLastLogout) {
		return $this->db->runQuery('UPDATE ' . MB_USERS . ' SET userLastLogout = "' . $userLastLogout . '" WHERE userLogin = "' . $userLogin . '"');
	}
	
	public function selectData($INDB, $selected, $all = false) {
		if($all === false) {
			return $this->db->runQuery('SELECT * FROM ' . MB_USERS . ' WHERE '. $INDB .' = "' . $selected . '"');
		} else {
			return $this->db->runQuery('SELECT '. $all .' FROM ' . MB_USERS . ' WHERE '. $INDB .' = "' . $selected . '"');
		}
	}
	
	public function selectRandomUID($column) {
		return $this->db->runQuery('SELECT '. $column .' FROM '. MB_USERS .' ORDER BY RAND() LIMIT 1');
	}
	
    public function setUserData($regDisplayName, $regLoginName, $regEmail, $regRePass, $userUID, $userType) {
		if(defined('TDSHASH_ON')) {
			$userPass = tds4($regRePass, TDSHASH_OWN_KEY, 5, 4, 55);
		} else {
			$userPass = md5($regRePass);
		}
		
        return $this->db->runQuery("INSERT INTO ". MB_USERS ." (userLogin,userNameDisplay,userPassword,userEmail,userUniqueID,userType)
		VALUES ('$regLoginName','$regDisplayName','$userPass','$regEmail','$userUID','$userType')");
    }

    public function checkLogin($userLogin, $userPassword) {
		if(defined('TDSHASH_ON')) {
			$userPass = tds4($userPassword, TDSHASH_OWN_KEY, 5, 4, 55);
		} else {
			$userPass = md5($userPassword);
		}
        return $this->db->runQuery("SELECT * FROM ". MB_USERS ." WHERE userLogin='$userLogin' AND userPassword='$userPass'");
    }

	public function getUsers($max) {
		return $this->db->runQuery('SELECT * FROM ' . MB_USERS . ' ORDER BY userID DESC LIMIT '.$max.'');
	}
	
	public function changePass($sessUserName, $userRepass) {
		return $this->db->runQuery('UPDATE ' . MB_USERS . ' SET userPassword = "' . tds4($userRepass, 1, 5, 4, 14) . '" WHERE userName = "' . $sessUserName . '"');
	}
	
	public function checkEmail($userEmail) {
		return $this->db->runQuery('SELECT * FROM ' . MB_USERS . ' WHERE userEmail = "' . $userEmail . '"');
	}
	
	public function setNewPassword($newPassword, $userEmail) {
		return $this->db->runQuery('UPDATE ' . MB_USERS . ' SET userPassword = "' . tds4($newPassword, 1, 5, 4, 14) . '" WHERE userEmail = "' . $userEmail . '"');
	}
	
	public function sendEmailPassword($userEmail, $title, $message) {
		return mail($userEmail, $title, $message);
	}
}













