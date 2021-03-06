<?php
/**
 * @file steps.php
 * @brief MartonBash Instalation
 * @last update 14 Oct 2012
 * @copyright (C) 2012 MartonBash Development
 * @license Common Development and Distribution License - www.opensource.org/licenses/CDDL-1.0
 * @package MartonBash CMS
 */

class Steps extends baseController {

	private $MB_SERVER,
			$MB_USERNAME,
			$MB_PASSWORD,
			$MB_DATABASE,
			$MB_TABLE_PREFIX,
			$prefix,
			$MB_ADMIN_USERNAME,
			$MB_ADMIN_DISPLAYNAME,
			$MB_ADMIN_PASSWORD,
			$MB_ADMIN_CONFIRM,
			$MB_ADMIN_EMAIL,
			$mb_crypt_password,
			$MB_WEBSITE_DIR,
			$MB_NEWS_PER_PAGE,
			$MB_HASH_SECURITY_KEY,
			$mb_own,
			$mb_hON,
			$mb_site_dir,
			$mb_per_page,
			$mb_create_config_table, $mb_create_articles_table, $mb_create_users_table, $mb_create_products_table,
			$mb_insert_config_table, $mb_insert_articles_table, $mb_insert_users_table, $mb_insert_products_table,
			$_steps;

	public function __construct() {
        parent::__construct();
		$this->_steps = array();
		$this->_steps['step_1'] = null;
		$this->_steps['step_2'] = null;
		$this->_steps['step_3'] = null;
    }

	public function step_1() {
		// $this->_steps['step_1'] = null;

			// $this->MB_SERVER = isset($_POST['MB_SERVER'])? tdsEsc($_POST['MB_SERVER']) : null;
			// $this->MB_USERNAME = isset($_POST['MB_USERNAME'])? tdsEsc($_POST['MB_USERNAME']) : null;
			// $this->MB_PASSWORD = isset($_POST['MB_PASSWORD'])? tdsEsc($_POST['MB_PASSWORD']) : null;
			// $this->MB_DATABASE = isset($_POST['MB_DATABASE'])? tdsEsc($_POST['MB_DATABASE']) : null;
			// $this->MB_TABLE_PREFIX = isset($_POST['MB_TABLE_PREFIX'])? tdsEsc($_POST['MB_TABLE_PREFIX']) : null;

			$MB_SERVER = isset($_POST['MB_SERVER'])? tdsEsc($_POST['MB_SERVER']) : null;
			$MB_USERNAME = isset($_POST['MB_USERNAME'])? tdsEsc($_POST['MB_USERNAME']) : null;
			$MB_PASSWORD = isset($_POST['MB_PASSWORD'])? tdsEsc($_POST['MB_PASSWORD']) : null;
			$MB_DATABASE = isset($_POST['MB_DATABASE'])? tdsEsc($_POST['MB_DATABASE']) : null;
			$MB_TABLE_PREFIX = isset($_POST['MB_TABLE_PREFIX'])? tdsEsc($_POST['MB_TABLE_PREFIX']) : null;


			if($MB_SERVER != NULL && $MB_USERNAME != NULL && $MB_PASSWORD != NULL && $MB_DATABASE != NULL) {
				if($this->_steps['step_1'] == null) {
					if($this->minLen($MB_SERVER) != 0 && $this->minLen($MB_USERNAME) != 0 && $this->minLen($MB_PASSWORD) != 0 && $this->minLen($MB_DATABASE) != 0) {
						if($MB_TABLE_PREFIX == NULL) {
							$this->prefix = 'mb_';
						} else {
							$this->prefix = $MB_TABLE_PREFIX;
						}
								$this->_steps['step_1'] = 'x';
								$this->_steps['step_2'] = 'x';
					} else {
						$this->view->load('errors/shortInput');
						$this->view->output(array(
							'TITLE'     => 'Too short - Step 1 - Miscelinious &bull; MartonBash CMS Installation',
						));
					}

			} else {
				unset($this->_steps);
				die("No direct access allowed");
			}
		} else {
			$this->view->load('install/step1');
			$this->view->output(array(
				'TITLE' => 'Step 1 - MySQL Details &bull; MartonBash CMS Installation'
			));
		}
	}

	public function step_2() {

			$MB_ADMIN_USERNAME = isset($_POST['MB_ADMIN_USERNAME'])? tdsEsc($_POST['MB_ADMIN_USERNAME']) : null;
			$MB_ADMIN_DISPLAYNAME = isset($_POST['MB_ADMIN_DISPLAYNAME'])? tdsEsc($_POST['MB_ADMIN_DISPLAYNAME']) : null;
			$MB_ADMIN_PASSWORD = isset($_POST['MB_ADMIN_PASSWORD'])? tdsEsc($_POST['MB_ADMIN_PASSWORD']) : null;
			$MB_ADMIN_CONFIRM = isset($_POST['MB_ADMIN_CONFIRM'])? tdsEsc($_POST['MB_ADMIN_CONFIRM']) : null;
			$MB_ADMIN_EMAIL = isset($_POST['MB_ADMIN_EMAIL'])? tdsEsc($_POST['MB_ADMIN_EMAIL']) : null;

		if($this->_steps['step_1'] != NULL && $this->_steps['step_2'] != NULL) {
			if($MB_ADMIN_USERNAME != NULL
			&& $MB_ADMIN_DISPLAYNAME != NULL
			&& $MB_ADMIN_PASSWORD != NULL
			&& $MB_ADMIN_CONFIRM != NULL
			&& $MB_ADMIN_EMAIL != NULL) {

					if(filter_var($MB_ADMIN_EMAIL, FILTER_VALIDATE_EMAIL)) {
						if($MB_ADMIN_PASSWORD == $MB_ADMIN_CONFIRM) {
							if($this->minLen($MB_ADMIN_USERNAME) != 0
							&& $this->minLen($MB_ADMIN_DISPLAYNAME) != 0
							&& $this->minLen($MB_ADMIN_PASSWORD) != 0
							&& $this->minLen($MB_ADMIN_CONFIRM) != 0
							&& $this->minLen($MB_ADMIN_EMAIL) != 0) {

								if(defined('MB_HASH_ON')) {
									$this->mb_crypt_password = tds4($MB_ADMIN_PASSWORD, MB_HASH_OWN_KEY, 5, 4, 2010321);
								} else {
									$this->mb_crypt_password = md5($MB_ADMIN_PASSWORD);
								}
									$this->_steps['step_1'] = 'x';
									$this->_steps['step_2'] = 'x';
									$this->_steps['step_3'] = 'x';
							} else {
								$this->view->load('errors/shortInput');
								$this->view->output(array(
									'TITLE'     => 'Too short - Step 2 - Admin Settings &bull; MartonBash CMS Installation',
								));
							}
						} else {
							$this->view->load('errors/donotMatch');
							$this->view->output(array(
								'TITLE'     => 'Passwords Not Match - Step 2 - Admin Settings &bull; MartonBash CMS Installation',
							));
						}
					} else {
						$this->view->load('errors/invalidEmail');
						$this->view->output(array(
							'TITLE'     => 'Invalid Email - Step 2 - Admin Settings &bull; MartonBash CMS Installation',
						));
					}

			} else {
				$this->view->load('install/step2');
				$this->view->output(array(
					'TITLE'     => 'Fields - Step 2 - Admin Settings &bull; MartonBash CMS Installation'
				));
			}
		} else {
			unset($this->_steps);
			die("No direct access allowed");
		}
	}

	public function step_3() {


			$MB_WEBSITE_DIR = isset($_POST['MB_WEBSITE_DIR'])? tdsEsc($_POST['MB_WEBSITE_DIR']) : null;
			$MB_NEWS_PER_PAGE = isset($_POST['MB_NEWS_PER_PAGE'])? tdsEsc($_POST['MB_NEWS_PER_PAGE']) : null;
			$MB_HASH_SECURITY_KEY = isset($_POST['MB_HASH_SECURITY_KEY'])? tdsEsc($_POST['MB_HASH_SECURITY_KEY']) : null;
		if($this->_steps['step_1'] != NULL && $this->_steps['step_2'] != NULL && $this->_steps['step_3'] != NULL) {
			if($MB_WEBSITE_DIR != NULL
			&& $MB_NEWS_PER_PAGE != NULL) {
				if(filter_var($MB_WEBSITE_DIR, FILTER_VALIDATE_URL)) {
					if($this->minLen($MB_WEBSITE_DIR) != 0) {
						if($MB_HASH_SECURITY_KEY == null) {
							$MB_HASH_SECURITY_KEY = "null";
							$mb_own = "2";
							$mb_hON = " #define('MB_HASH_ON', true); 										# set '#' at line start to STOP TDS HASHING secure";
						} else {
							$MB_HASH_SECURITY_KEY = $MB_HASH_SECURITY_KEY;
							$mb_own = "1";
							$mb_hON = " define('MB_HASH_ON', true); 										# set '#' at line start to STOP TDS HASHING secure";
						}
						$mb_site_dir = $MB_WEBSITE_DIR;
						$mb_per_page = $MB_NEWS_PER_PAGE;
						$this->_steps['installation'] = true;
					} else {
						$this->view->load('errors/shortInput');
						$this->view->output(array(
							'TITLE'     => 'Too short - Step 3 - System Settings &bull; MartonBash CMS Installation',
						));
					}
				} else {
					$this->view->load('errors/emptyInput');
					$this->view->output(array(
						'TITLE'     => 'Invalid Web Address - Step 3 - System Settings &bull; MartonBash CMS Installation',
					));
				}
			} else {
				$this->view->load('install/step3');
				$this->view->output(array(
					'TITLE'     => 'Fields - Step 3 - System Settings &bull; MartonBash CMS Installation'
				));
			}
		} else {
			unset($this->_steps);
			die("No direct access allowed");
		}
	}

	public function insertTables() {
		if(isset($_POST['installation']) && $this->_steps['installation'] != true && $this->_steps['step_1'] != NULL && $this->_steps['step_2'] != NULL && $this->_steps['step_3'] != NULL) {
		if(isset($_POST['installation'])) {
			$this->connect = mysql_connect('localhost', 'satanolc_tunncko', 'z68nikoletka') or die(mysql_error());;
			$this->select = mysql_select_db('satanolc_nuclear', $this->connect) or die(mysql_error());;

			$this->mb_create_config_table = "CREATE TABLE IF NOT EXISTS `localhost_config` (
				`TITLE` varchar(255) CHARACTER SET utf8 NOT NULL,
				`DESC` varchar(255) CHARACTER SET utf8 NOT NULL,
				`KEYWORDS` varchar(255) CHARACTER SET utf8 NOT NULL,
				`BASE_URL` varchar(255) CHARACTER SET utf8 NOT NULL,
				`DOMAIN` varchar(255) CHARACTER SET utf8 NOT NULL,
				`ROBOTS` varchar(50) CHARACTER SET utf8 NOT NULL,
				`GOOGLEBOT` varchar(50) CHARACTER SET utf8 NOT NULL,
				`OG_SITE_NAME` varchar(255) CHARACTER SET utf8 NOT NULL,
				`TEMPLATE_PATH` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'template',
				`TEMPLATE_NAME` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'cse',
				`404_DIR` varchar(255) CHARACTER SET utf8 NOT NULL,
				`PER_PAGE` int(11) NOT NULL DEFAULT '5'
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

			$this->mb_create_articles_table = "CREATE TABLE IF NOT EXISTS `localhost_news` (
			  `newsID` int(11) NOT NULL AUTO_INCREMENT,
			  `newsName` varchar(100) NOT NULL,
			  `newsTitle` varchar(100) NOT NULL,
			  `newsText` text NOT NULL,
			  `newsAuthor` varchar(25) NOT NULL,
			  `newsDate` varchar(25) NOT NULL,
			  `newsTags` varchar(255) NOT NULL,
			  `newsSEOurl` varchar(255) NOT NULL,
			  PRIMARY KEY (`newsID`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21;";

			$this->mb_create_users_table = "CREATE TABLE IF NOT EXISTS `localhost_users` (
			  `userID` int(11) NOT NULL AUTO_INCREMENT,
			  `userUniqueID` varchar(255) NOT NULL,
			  `userNameDisplay` varchar(255) NOT NULL,
			  `userLogin` varchar(25) NOT NULL,
			  `userPassword` varchar(15) NOT NULL,
			  `userEmail` varchar(255) NOT NULL,
			  `userType` varchar(50) NOT NULL,
			  `userLastLogout` varchar(255) NOT NULL,
			  PRIMARY KEY (`userID`),
			  UNIQUE KEY `userUniqueID` (`userUniqueID`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;";

			$this->mb_create_products_table = "CREATE TABLE IF NOT EXISTS `localhost_products` (
				`productID` int(11) NOT NULL AUTO_INCREMENT,
				`productName` varchar(150) NOT NULL,
				`productTitle` varchar(200) NOT NULL,
				`productDesc` text NOT NULL,
				`productSEOurl` varchar(255) NOT NULL,
				`productTags` varchar(255) NOT NULL,
				`productModel` varchar(100) NOT NULL,
				`productPrice` varchar(20) NOT NULL,
				`productUnits` varchar(255) NOT NULL,
				`productUnitsIn` varchar(255) NOT NULL,
				`productUnitsInPack` varchar(255) NOT NULL,
				PRIMARY KEY (`productID`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;";

			if(!empty($this->mb_create_config_table) && !empty($this->mb_create_articles_table) && !empty($this->mb_create_users_table) && !empty($this->mb_create_products_table)) {
				if(mysql_query($this->mb_create_config_table)) {
					$this->mb_insert_config_table = "INSERT INTO `localhost_config` (`TITLE`, `DESC`, `KEYWORDS`, `BASE_URL`, `ROBOTS`, `GOOGLEBOT`, `OG_SITE_NAME`, `TEMPLATE_PATH`, `TEMPLATE_NAME`, `404_DIR`, `PER_PAGE`) VALUES ('MartonBash CMS - We Create', 'MartonBash CMS - free lightweight , fast and easy-to-manage system', 'martonbash, mbash revolution,mbash cse, martonbash cms, content management system martonbash,cms mbash,template engine', '".$this->mb_site_dir."', 'index,follow', 'index,follow', 'MartonBash CMS - We Create', 'template', 'cse (default)', '".$this->mb_site_dir."404page.png', 3);";
				}
				if(mysql_query($this->mb_create_articles_table)) {
					$this->mb_insert_articles_table = "INSERT INTO `localhost_news` (`newsID`, `newsName`, `newsTitle`, `newsText`, `newsAuthor`, `newsDate`, `newsTags`, `newsSEOurl`) VALUES (1, 'Òåñòîâà ïúðâà íîâèíà', 'Òåñòîâà íîâèíà êàòî çà íà÷àëî', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel porta erat. Quisque sit amet risus at odio pellentesque sollicitudin. Proin suscipit molestie facilisis. Aenean vel massa magna. Proin nec lacinia augue. Mauris venenatis libero nec odio viverra consequat. In hac habitasse platea dictumst.', '".$this->MB_ADMIN_DISPLAYNAME."', '1348410722', 'test martonbash cms, test tag2', 'test-novina.html');";
				}
				if(mysql_query($this->mb_create_users_table)) {
					$this->mb_insert_users_table = "INSERT INTO `localhost_users` (`userID`, `userUniqueID`, `userNameDisplay`, `userLogin`, `userPassword`, `userEmail`, `userType`, `userLastLogout`) VALUES (1, '000000', '".$this->MB_ADMIN_DISPLAYNAME."', '".MB_ADMIN_USERNAME."', '".$this->mb_crypt_password."', 'admin@liababy.com', '3', '1350001796');";
				}
				if(mysql_query($this->mb_create_products_table)) {
					$this->mb_insert_products_table = "INSERT INTO `localhost_products` (`productID`, `productName`, `productTitle`, `productDesc`, `productSEOurl`, `productTags`, `productModel`, `productPrice`, `productUnits`, `productUnitsIn`, `productUnitsInPack`) VALUES (1, 'Test products ', 'Test product title', '[img]".$this->mb_site_dir."public/images/products/CIMG3323.png[/img]\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nñàñàsssasda', 'test-product-seo-url-martonbash.html', 'test martonbash, test product, martonbash cms', 'ssp', '2.11', '11', '24', '64'));";
				}
				if(!mysql_error()) {
					$this->install_MB(1);
				} else {
					$this->install_MB(2);
				}
			}
		}
			} else {
				exit;
			}
	}

	public function install_MB($val) {
		if($val == 2) {
			die(mysql_error());
		} elseif($val == 1) {
$fileContent = "<?php
/**
 * @file configure.php
 * @brief Configures Settings
 * @last update 13 Oct 2012
 * @copyright (C) 2012 MartonBash Development
 * @license Common Development and Distribution License -
 * @package MartonBash CMS
 */
 #
 define('MB_CMS', true);
 define('MB_ROOT',dirname(__FILE__).'/');
 define('MB_PATH',dirname(__FILE__).'/');
#define('CERR_HANDLER', true);										# remove '#' at line start to show all errors
if(defined('CERR_HANDLER')) error_reporting(-1);
# -----------------------------------------------------------------------------+
# MYSQL CONNECTION INFO
 define('MB_SERVER', '".$this->MB_SERVER."');
 define('MB_USERNAME', '".$this->MB_USERNAME."');
 define('MB_PASSWORD', '".$this->MB_PASSWORD."');
 define('MB_DATABASE', '".$this->MB_DATABASE."');
# -----------------------------------------------------------------------------+
# INCLUDES
 require(MB_ROOT.'libs/iMartonBashControllers.php');
 require(MB_ROOT.'libs/Model.php');
 require(MB_ROOT.'libs/aBaseController.php');
 require(MB_ROOT.'libs/aBaseView.php');
 require(MB_ROOT.'controllers/baseController.php');
 require(MB_ROOT.'controllers/baseView.php');
 require(MB_ROOT.'libs/Session.php');
 require(MB_ROOT.'libs/Bootstrap.php');
 require(MB_ROOT.'libs/Libs.php');
 require(MB_ROOT.'libs/tds4.php');
 require(MB_ROOT.'libs/Database.php');
 require(MB_ROOT.'libs/Pagination.php');
# -----------------------------------------------------------------------------+
# SET MAIN DATA
 define('MB_USER_TYPE', '1'); 										# user group number
 define('MB_ACCESS_TYPE', '3'); 									# admin group number
#define('MB_ACCESS_LOGIN', '".$this->MB_ADMIN_USERNAME."'); 			# admin login name
".$this->mb_hON."
 define('MB_HASH_SECURITY_KEY', '".$this->mb_key."');				# The security hashkey
 define('MB_HASH_OWN_KEY', ".$this->mb_own.");						# Set to 1 - if you use your own hashkey (previous row), 2 - if you not
 define('MB_SHOW_SQL_ERRORS', true); 								# set '#' at line start to stop showing all MySQL errors and quiries
# -----------------------------------------------------------------------------+
# MYSQL DETAILS
 define('MB_CONFIG', '".$this->prefix."config');
 define('MB_USERS', '".$this->prefix."users');
 define('MB_NEWS', '".$this->prefix."news');
 define('MB_PRODUCTS', '".$this->prefix."products');
# -----------------------------------------------------------------------------+
# SET MAIN ENCODING
 header('Content-Type: text/html; charset=UTF-8');
# -----------------------------------------------------------------------------+
# START SESSION
 Session::startSess();
	";
			$file_name = fopen('../configure.php', 'w');
			$file_create = fwrite($file_name, $fileContent);
			fclose($file_name);
			$this->view->load('install/success');
			$this->view->output(array(
				'TITLE'     => 'Successfull Install &bull; MartonBash CMS Installation',
			));
		} else {
			die("No direct access allowed");
		}
	}

	public function minLen($value) {
		if(strlen($value) > 4) { return 1; }
		else {
			$this->view->load('errors/shortInput');
			$this->view->output(array(
				'TITLE'     => 'Instaltion Home Page',
			));
			return 0;
		}
	}

	public function checkMethod($numPrevStep,$title) {
		$this->_steps = $numPrevStep;
		$this->view->load('install/step'.$numPrevStep);
		$this->view->output(array(
			'TITLE'     => 'Step '.$numPrevStep.' - '.$title.' &bull; MartonBash CMS Installation',
		));
		$this->step_.$numPrevStep;
	}

	public function fileContent() {
		$this->file_content = "
<?php
/**
 * @file configure.php
 * @brief Configures Settings
 * @last update 13 Oct 2012
 * @copyright (C) 2012 MartonBash Development
 * @license Common Development and Distribution License -
 * @package MartonBash CMS
 */
 #
 define('MB_CMS', true);
 define('MB_ROOT',dirname(__FILE__).'/');
 define('MB_PATH',dirname(__FILE__).'/');
#define('CERR_HANDLER', true);										# remove '#' at line start to show all errors
if(defined('CERR_HANDLER')) error_reporting(-1);
# -----------------------------------------------------------------------------+
# MYSQL CONNECTION INFO
 define('MB_SERVER', '".$this->MB_SERVER."');
 define('MB_USERNAME', '".$this->MB_USERNAME."');
 define('MB_PASSWORD', '".$this->MB_PASSWORD."');
 define('MB_DATABASE', '".$this->MB_DATABASE."');
# -----------------------------------------------------------------------------+
# INCLUDES
 require(MB_ROOT.'libs/iMartonBashControllers.php');
 require(MB_ROOT.'libs/Model.php');
 require(MB_ROOT.'libs/aBaseController.php');
 require(MB_ROOT.'libs/aBaseView.php');
 require(MB_ROOT.'controllers/baseController.php');
 require(MB_ROOT.'controllers/baseView.php');
 require(MB_ROOT.'libs/Session.php');
 require(MB_ROOT.'libs/Bootstrap.php');
 require(MB_ROOT.'libs/Libs.php');
 require(MB_ROOT.'libs/tds4.php');
 require(MB_ROOT.'libs/Database.php');
 require(MB_ROOT.'libs/Pagination.php');
# -----------------------------------------------------------------------------+
# SET MAIN DATA
 define('MB_USER_TYPE', '1'); 										# user group number
 define('MB_ACCESS_TYPE', '3'); 									# admin group number
#define('MB_ACCESS_LOGIN', '".$this->mb_admin_login."'); 			# admin login name
".$this->mb_hON."
 define('MB_HASH_SECURITY_KEY', '".$this->mb_key."');				# The security hashkey
 define('MB_HASH_OWN_KEY', ".$this->mb_own.");						# Set to 1 - if you use your own hashkey (previous row), 2 - if you not
 define('MB_SHOW_SQL_ERRORS', true); 								# set '#' at line start to stop showing all MySQL errors and quiries
# -----------------------------------------------------------------------------+
# MYSQL DETAILS
 define('MB_CONFIG', '".$this->prefix."config');
 define('MB_USERS', '".$this->prefix."users');
 define('MB_NEWS', '".$this->prefix."news');
 define('MB_PRODUCTS', '".$this->prefix."products');
# -----------------------------------------------------------------------------+
# SET MAIN ENCODING
 header('Content-Type: text/html; charset=UTF-8');
# -----------------------------------------------------------------------------+
# START SESSION
 Session::startSess();
	";
		return $$this->file_content;
	}

	public function error() {
		$this->view->load('install/error');
		$this->view->output(array(
			'TITLE'     => 'Page Not Found'
		));
	}
}
