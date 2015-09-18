<?php
/**
 * @file configure.php
 * @brief Configuration point
 * @author MartonBash Development
 * @version 2.25d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */

#
 define('WEB_PATH',realpath(dirname(__FILE__)).'/');
# -----------------------------------------------------------------------------+
# SHOW ALL ERRORS
# define('CERR_HANDLER', true);										# set '#' at line start to stop
 if(defined('CERR_HANDLER')) error_reporting(-1);
# -----------------------------------------------------------------------------+
# MYSQL CONNECTION INFO
 define('DB_HOST', 'localhost');
 define('DB_USER', '');
 define('DB_PASS', '');
 define('DB_NAME', '');
# -----------------------------------------------------------------------------+
# DATABASE TABLES
 define('MB_CONFIG', 'cse_config');
 define('MB_USERS', 'cse_users');
 define('MB_NEWS', 'cse_news');
 define('MB_PRODUCTS', 'mb_lia_products');
# -----------------------------------------------------------------------------+
# INCLUDES
 require(WEB_PATH.'libs/iMartonBashControllers.php');
 require(WEB_PATH.'libs/Model.php');
 require(WEB_PATH.'libs/aBaseController.php');
 require(WEB_PATH.'libs/aBaseView.php');
 require(WEB_PATH.'controllers/baseController.php');
 require(WEB_PATH.'controllers/baseView.php');
 require(WEB_PATH.'controllers/installView.php');
 require(WEB_PATH.'libs/Session.php');
 require(WEB_PATH.'libs/Bootstrap.php');
 require(WEB_PATH.'libs/Libs.php');
 require(WEB_PATH.'libs/tds4.php');
 require(WEB_PATH.'libs/Database.php');
 require(WEB_PATH.'libs/Pagination.php');
# -----------------------------------------------------------------------------+
# SET MAIN DATA
 define('BASH_USER_TYPE', '1'); 									# user group number
 define('BASH_ACCESS_TYPE', '3'); 									# admin group number
# define('BASH_ACCESS_LOGIN', 'tunnckoCore'); 						# admin login name

 define('MB_HASH_ON', true); 										# set '#' at line start to STOP TDS HASHING secure
 define('MB_HASH_SECURITY_KEY', 'cantdecodethishash');				# The security hashkey settings
 define('MB_HASH_OWN_KEY', 1);									    # Set to 1 - if you use your own hashkey, 2 - if you not

 define('SHOW_SQL_ERRORS', true); 									# set '#' at line start to stop showing all MySQL errors and quiries
 define('MB_INSTALL_DIR','installation');
# -----------------------------------------------------------------------------+
# SET MAIN ENCODING
 header('Content-Type: text/html; charset=UTF-8');
# -----------------------------------------------------------------------------+
# START SESSION
 Session::startSess();

