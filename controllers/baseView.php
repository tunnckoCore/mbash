<?php
/**
 * @file baseView.php
 * @brief Base View router
 * @author MartonBash Development
 * @version 4.24d
 * @last update 13 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class baseView extends aBaseView {

	private $_template,
			$_vars,
			$_templateHeader,
			$_templateContent,
			$_templateFooter;

	public $_templatePath;

	public function __construct($templatePath) {
		$this->_templatePath = $templatePath;
		// $this->counter_PHP();
		// $hits = Session::getSess('allhits');
	}

	public function loadTemplate($templateName, $version) {

		$this->_templateHeader = $this->_templatePath ."/header.tpl.php";
		$this->_templateContent = $this->_templatePath ."/". $templateName .".php";
		$this->_templateFooter = $this->_templatePath ."/footer.tpl.php";

		$this->_assetsPath = $this->dataInfo['BASE_URL'].$this->_templatePath.'/assets';

		$this->cseMenuLinks();
		$this->cseSideLoginBox();
		$this->liababyMenuLinks();

		/* $version = 1 - full */
		if($version == 1) {

			if (is_dir($this->_templatePath)) {

				$this->_template = file_get_contents($this->_templateHeader);

				if($this->dataInfo != NULL) {
					$this->setTags('TITLE',$this->dataInfo['TITLE']);
					$this->setTags('DESC',$this->dataInfo['DESC']);
					$this->setTags('KEYWORDS',$this->dataInfo['KEYWORDS']);

					$this->setTags('OG_SITE_NAME',$this->dataInfo['OG_SITE_NAME']);
					$this->setTags('OG_TYPE','website');
					$this->setTags('OG_TITLE',$this->dataInfo['TITLE']);

					$this->setTags('CANONICAL',$this->dataInfo['BASE_URL'].'index');
					$this->setTags('MAIN_PATH',$this->dataInfo['BASE_URL']);
					$this->setTags('BASE_PATH',$this->dataInfo['BASE_URL'].$this->_templatePath.'/assets');

					$this->setTags('COPYRIGHT',$this->dataInfo['DOMAIN']);
					$this->setTags('ROBOTS',$this->dataInfo['ROBOTS']);
					$this->setTags('GOOGLEBOT',$this->dataInfo['GOOGLEBOT']);

					$this->setTags('MORE_OPG','');

					// Session::setSess('user_visits',$i++);
					// $this->setTags('COUNTER',Session::getSess('user_visits'));

					// $this->phpCounter();
					// $this->setTags('VISITS_UNIQUE',$this->phpCounter());

					/* CSE Template */
					$this->setTags('CSE_MENU_LINKS',$this->cseMenuLinks);
					$this->setTags('CSE_SIDELOGIN_BOX',$this->cseSideLoginBox);

					/* LIABABY Template */
					$this->setTags('LIA_MENU_LINKS',$this->liababyMenuLinks);

					/* LIABABY Slider Load */
					$this->setTags('MIDDLE',$this->loadLiaSlider());
				}
			} else {
				$this->_templateHeader = "template/cse (default)/header.tpl.php";
				$this->_templateContent = "template/cse (default)/". $templateName .".php";
				$this->_templateFooter = "template/cse (default)/footer.tpl.php";

				$this->_template = file_get_contents("template/cse (default)/header.tpl.php");
				if($this->dataInfo != NULL) {
					$this->setTags('TITLE',$this->dataInfo['TITLE']);
					$this->setTags('DESC',$this->dataInfo['DESC']);
					$this->setTags('KEYWORDS',$this->dataInfo['KEYWORDS']);

					$this->setTags('OG_SITE_NAME',$this->dataInfo['OG_SITE_NAME']);
					$this->setTags('OG_TYPE','website');
					$this->setTags('OG_TITLE',$this->dataInfo['TITLE']);

					$this->setTags('CANONICAL',$this->dataInfo['BASE_URL'].'index');
					$this->setTags('MAIN_PATH',$this->dataInfo['BASE_URL']);
					$this->setTags('BASE_PATH',$this->dataInfo['BASE_URL'].'template/cse (default)/assets');

					$this->setTags('COPYRIGHT',$this->dataInfo['DOMAIN']);
					$this->setTags('ROBOTS',$this->dataInfo['ROBOTS']);
					$this->setTags('GOOGLEBOT',$this->dataInfo['GOOGLEBOT']);

					$this->setTags('MORE_OPG','');

					// $this->phpCounter();
					// $this->setTags('VISITS_UNIQUE',$this->phpCounter());

					/* CSE Template */
					$this->setTags('CSE_MENU_LINKS',$this->cseMenuLinks);
					$this->setTags('CSE_SIDELOGIN_BOX',$this->cseSideLoginBox);

					/* LIABABY Template */
					$this->setTags('LIA_MENU_LINKS',$this->liababyMenuLinks);

					/* LIABABY Slider Load */
					$this->setTags('MIDDLE',$this->loadLiaSlider());
				}
			}


			$this->render('<?# ',' ?>');
			if (file_exists($this->_templateContent)) { require $this->_templateContent;


			}
			if (file_exists($this->_templateFooter)) { require $this->_templateFooter; }

		} elseif($version == 2) {
			if (file_exists($this->_templateHeader)) {

				$this->_template = file_get_contents($this->_templateHeader);

			} else {
				$this->_templateHeader = $this->dataInfo['TEMPLATE_PATH']."/cse (default)/header.tpl.php";
				$this->_templateContent = $this->dataInfo['TEMPLATE_PATH']."/cse (default)/". $templateName .".php";
				$this->_templateFooter = $this->dataInfo['TEMPLATE_PATH']."/cse (default)/footer.tpl.php";

				$this->_template = file_get_contents($this->dataInfo['TEMPLATE_PATH']."/cse (default)/header.tpl.php");
			}
		}
	}

	/* @uses by system to define tpl tags */
	protected function setTags($key,$value)
	{
		if (!isset($key) && isset($value)) return;  // Assigning value to non-existing key
		$this->_vars[$key] = $value;
	}

	/* @uses by owner to define tpl tags */
    public function assign($key,$value)
	{
        if (!isset($key) && isset($value)) return;  // Assigning value to non-existing key

        $this->_vars[$key] = $value;
	}

	/*
		return array of config data
		from config table in db
	*/
	public function dataSetter($infoArray) {
		foreach ($infoArray as $key => $value) {
			$this->dataInfo[$key] = $value;
		}
	}

	/*
		Set SEO url links

		@example:
				martonbashcms.com/user/viewprofile/ad min
			--> martonbashcms.com/user/viewprofile/ad-min.html
	*/
	protected function setUrl($value) {
		$set = Session::getSess($value);
		$set = str_replace(' ', '-', $set);
		$set = $set.".html";
		return $set;
	}

	/*
		Generate CSE's login box or user profile preview
	*/
	public function cseSideLoginBox() {

		if(Session::getSess('logged') == false ) {

			$this->cseSideLoginBox .= '
				<div class="grid_up hr dark bold500 radius_5_top textcenter">Вход в системата</div>
				<div class="grid_bottom pall_20">
				<form action="'. $this->dataInfo['BASE_URL'] .'user/logIn" method="post">

					<input type="text" name="userLogin" value="Име за вход" class="user ml_10 mb_10 radius_5_all boldtext"/>
					<input type="password" name="userPassword" value="************" class="pass ml_10 radius_5_all boldtext"/>

					<input type="submit" name="login" class="loginButton ml_10 mt_10 boldtext radius_5_all" value="Вход"/>
					или <a href="'. $this->dataInfo['BASE_URL'] .'user/regUser" class="registerButton">Регистрация</a>
				</form>
				</div>
			';
		} else {

			$username = $this->setUrl('userNameDisplay');
			$this->cseSideLoginBox = '
				<div class="grid_up hr dark bold500 radius_5_top textcenter">Потребителски профил</div>
				<div class="grid_bottom">
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">User Login:</span> <span class="it right fontSize15" style="padding-top: 3px;">'.Session::getSess('userLogin').'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">Display Name:</span> <span class="it right fontSize15" style="padding-top: 3px;">'.Session::getSess('userNameDisplay').'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">E-mail:</span> <span class="it right fontSize15" style="padding-top: 3px;">'.Session::getSess('userEmail').'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">Password:</span> <span class="it right fontSize15" style="padding-top: 3px;">'.Session::getSess('userPassword').'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">Last seen:</span> <span class="it right fontSize15" style="padding-top: 3px;">'.$this->getLoginTime().'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">Logged at</span> <span class="it right fontSize15" style="padding-top: 3px;">'.date("H:i:s, j.m.Y", Session::getSess('userLogInTime')).'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border pt_5"><span class="boldtext fontSize14">UniqueID:</span> <span class="it right fontSize15" style="padding-top: 3px;">'.Session::getSess('userUniqueID').'</span></p>
					<p style="margin-top: 1px;" class="border1 info pall_5 border clearfix pt_5"><span class="boldtext left fontSize14" style="padding-top: 3px;">Rank: '.$this->getUserType().'</span>
				<span class="right fontSize15" style="padding-top: 3px;">[ <a href="'.$this->dataInfo['BASE_URL'].'user/userProfile/'.$username.'" class="adm">
				Редактиране</a> ]</span>
					</p>
				</div>';


		}
	}
	/*
		Generate CSE's horizontal menu links
	*/
	public function cseMenuLinks() {

		if(Session::getSess('logged') == false) {
			$this->cseMenuLinks .= '
				<li><a href="'. $this->dataInfo['BASE_URL'] .'user/regUser"><span>Регистрация</span></a></li>
				<li><a href="'. $this->dataInfo['BASE_URL'] .'user/logIn"><span>Вход</span></a></li>
			';
		} else {
			$username = $this->setUrl('userNameDisplay');
			$this->cseMenuLinks .= '
				<li><a href="'. $this->dataInfo['BASE_URL'] .'user/userProfile/'. $username .'"><span>Настройки</span></a></li>
				<li><a href="'. $this->dataInfo['BASE_URL'] .'user/logOut"><span>Изход</span></a></li>
			';
		}
	}
	/*
		Generate LIABABY's menu links
	*/
	public function liababyMenuLinks() {

		if(Session::getSess('logged') == false) {
			$this->liababyMenuLinks .= '
				<li><a href="'. $this->dataInfo['BASE_URL'] .'user/regUser" title="" subtitle="Присъедини се">Регистрация</a></li>
				<li><a href="'. $this->dataInfo['BASE_URL'] .'user/logIn" title="" subtitle="Влез в сайта" class="last">Вход</a></li>
			';
		} else {
			$username = $this->setUrl('userNameDisplay');
			$this->liababyMenuLinks .= '
		<li><a href="'. $this->dataInfo['BASE_URL'] .'user/userProfile/'. $username .'" title="" subtitle="вашият профил">Профил</a></li>
		<li><a href="'. $this->dataInfo['BASE_URL'] .'user/logOut" title="" subtitle="от профила" class="last">Изход</a></li>
			';
		}
	}

	/*
		@return last logout/login date/time
		if $userLastLogout == null it preview logged time
		else it preview last logout time
	*/
	protected function getLoginTime() {
		if(Session::getSess('userLastLogout') == NULL) {
			$time = date("H:i:s, j.m.Y", Session::getSess('userLogInTime'));
		} else {

			$logoutTime = isset($logoutTime) ? $logoutTime : null;

				if($logoutTime == null) {
					$logoutTime = Session::getSess('userLastLogout');
				} else {
					$logoutTime = Session::getSess('userLogInTime');
				}

			$time = date("H:i:s, j.m.Y", $logoutTime);
		}
			return $time;
	}

	protected function getUserType() {
		if(Session::getSess('userType') == 3) { $userType = '<span class="red">Owner</span>'; }
		else { $userType = 'Member'; }
			return $userType;
	}

	public function loadLiaSlider() {
		$middle = '
				<div class="slider">
					<div>
						<div class="slidercontent"> <img src="'.$this->_assetsPath.'/images/products/CIMG3323png.PNG" style="border: 2px solid #777;" alt="Web Hosting" class="floatleft"/>
							<div class="slidertext">
							<h2>Baby Crema мокри кърпи - лайка</h2>
								<p>72 броя в пакет. Изключително нова формула 100% нетъкан текстил с натурални екстракти от лайка и бадемово масло.
								</p>
							</div>
						</div>
					</div>
					<div>
						<div class="slidercontent"> <img src="'.$this->_assetsPath.'/images/products/CIMG3324.png" style="border: 2px solid #777;" alt="Web Hosting" class="floatleft" />
							<div class="slidertext">
							<h2>Baby Love мокри кърпи - лайка</h2>
								<p>72 броя в пакет. Изключително нова формула 100% нетъкан текстил с натурални екстракти от лайка и бадемово масло.
								</p>
							</div>
						</div>
					</div>
					<div>
						<div class="slidercontent"> <img src="'.$this->_assetsPath.'/images/products/CIMG3325.png" style="border: 2px solid #777;" alt="Web Hosting" class="floatleft" />
							<div class="slidertext">
							<h2>Lovely Baby мокри кърпи - лайка и бадем</h2>
								<p>72 броя в пакет. Изключително нова формула 100% нетъкан текстил с натурални екстракти от лайка и бадемово масло.
								</p>
							</div>
						</div>
					</div>
					<div>
						<div class="slidercontent"> <img src="'.$this->_assetsPath.'/images/products/CIMG3330.png" style="border: 2px solid #777;" alt="Web Hosting" class="floatleft" />
							<div class="slidertext">
							<h2>CAN BEBE - Extra Soft</h2>
								<p>72бр. в пакет с етикет. Мокрите кърпи Extra Soft почистват и придават на кожата влага и мекота.
								Благодарение на антибактериалното свойство защитават кожата от бактерии.
								Не съдържат алкохол
								</p>
							</div>
						</div>
					</div>
					<div>
						<div class="slidercontent"> <img src="'.$this->_assetsPath.'/images/products/CIMG3331.png" style="border: 2px solid #777;" alt="Web Hosting" class="floatleft" />
							<div class="slidertext">
							<h2>Мокри кърпи CAN BEBE - MAX</h2>
								<p>88бр. в пакет с етикет. Мокрите кърпи Extra Soft почистват и придават на кожата влага и мекота.
								Благодарение на антибактериалното свойство защитават кожата от бактерии.
								Не съдържат алкохол
								</p>
							</div>
						</div>
					</div>
				</div>
			';
			return $middle;
	}

	public function phpCounter() {
		$filename = "counts.txt";
		$ip_filename = "ips.txt";

		$IP = $_SERVER['REMOTE_ADDR'];

			if(!in_array($IP, file($ip_filename, FILE_IGNORE_NEW_LINES))) {
				$uniques_count = (is_readable($filename)) ? file_get_contents($filename) : 0;
				file_put_contents($filename, ++$uniques_count);
				file_put_contents($ip_filename, $IP."\n", FILE_APPEND);
			}
			// echo $i++;
	}

	/* @uses by owner to close defining tpl tags */
	public function endLoad() {
		$this->setTags('CSE_MENU_LINKS',$this->cseMenuLinks);
		$this->setTags('CSE_SIDELOGIN_BOX',$this->cseSideLoginBox);
		$this->setTags('LIA_MENU_LINKS',$this->liababyMenuLinks);
		// $this->phpCounter();
		// $this->setTags('VISITS_UNIQUE',$this->phpCounter());
		// Session::setSess('user_visits',$i++);
		// $this->setTags('COUNTER',Session::getSess('user_visits'));



		/*
			if template exist call him
			else load default
		*/
		if(is_dir($this->_templatePath)) {
			$this->setTags('BASE_PATH',$this->dataInfo['BASE_URL'].$this->dataInfo['TEMPLATE_PATH'].'/'.$this->dataInfo['TEMPLATE_NAME'].'/assets');
		} else {
			$this->setTags('BASE_PATH',$this->dataInfo['BASE_URL'].'template/cse (default)/assets');
		}

		$this->render('<?# ',' ?>');

		if (file_exists($this->_templateContent)) { require $this->_templateContent; }
		if (file_exists($this->_templateFooter)) {require $this->_templateFooter; }
	}

    public function render($beginToken,$endToken, $return = true)
    {
        foreach ($this->_vars as $key => $value)
        {
            $this->_template = str_replace($beginToken . $key . $endToken,$value,$this->_template);
        }
		echo $this->_template;
    }

}
