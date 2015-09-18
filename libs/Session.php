<?php
/**
 * @file Session.php
 * @author MartonBash Development
 * @version 0.001d
 * @last update 12 Aug 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Session  {
	
    public static function startSess() {
        session_start();
    }

    public static function setSess($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function getSess($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

}