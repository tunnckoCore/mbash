<?php
/**
 * @file home.php
 * @brief Preview of index and preview of articles
 * @author MartonBash Development
 * @version 4.78d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Home extends baseController implements iMartonBashControllers {

    public function __construct() {
        parent::__construct();
    }
	
    public function index() {
        $this->loadModel('home');
		
		$info = isset($this->config) ? $this->config : null;
		$this->view->dataSetter($info);
		
		$this->newsMax = $this->maxNews();
		$paging = new Pag($info['PER_PAGE'], $this->newsMax);
		
			/* Date/Time */
			$this->conf['randUID'] = date("M d Y, H:i:s");
			$this->view->uniq[] = $this->conf;
		
        $this->query = $this->model->getPages($paging->limit['first'], $paging->limit['second']);
        while ($row = sqlFetchRow($this->query)) {
            $this->getNewsData['newsID'] = $row['newsID'];
            $this->getNewsData['newsName'] = $row['newsName'];
			$this->getNewsData['newsTitle'] = $row['newsTitle'];
            $this->getNewsData['newsAuthor'] = $row['newsAuthor'];
            $this->getNewsData['newsTags'] = $row['newsTags'];
            $this->getNewsData['newsDate'] = $row['newsDate'];
            $this->getNewsData['newsSEOurl'] = $row['newsSEOurl'];
			$this->getNewsData['MAIN_PATH'] = $info['BASE_URL'];
            $this->getNewsData['newsText'] = bbcodeParser($row['newsText']);
			$this->getNewsData['newsMax'] = $this->newsMax;
			$this->getNewsData['PER_PAGE'] = $info['PER_PAGE'];
			if (mysql_num_rows($this->query) == 0) {
				$this->getNewsData['noNews'] = 1;            
			}
			$this->view->setNewsData[] = $this->getNewsData;
        }
			
		/* Load Template
		**/
			$this->view->loadTemplate('home/index', 1);
	}
	
    public function addArticle() {
        if (Session::getSess('logged') == false) {
			header('Location: ../../index');
		} else {
            if (Session::getSess('userType') != BASH_ACCESS_TYPE) {
                header('Location: ../../index');
            } else {
                $this->loadModel('home');
				
					$info = isset($this->config) ? $this->config : null;
					$this->view->dataSetter($info);
				
                if (isset($_POST['add'])) {
					$newsName = isset($_POST['newsName'])? tdsEsc($_POST['newsName']) : null;
					$newsTitle = isset($_POST['newsTitle'])? tdsEsc($_POST['newsTitle']) : null;
					$newsText = isset($_POST['newsText'])? tdsEsc($_POST['newsText']) : null;
					$newsTags = isset($_POST['newsTags'])? tdsEsc($_POST['newsTags']) : null;
					$newsSEOurl = isset($_POST['newsSEOurl'])? tdsEsc($_POST['newsSEOurl']) : null;
					$author = Session::getSess('userNameDisplay');
					$newsAuthor = isset($author) ? tdsEsc($author) : null;
                    $newsDate = time();
					
					//cannot be empty field
                    if ($newsName != NULL && $newsTitle != NULL && $newsText != NULL && $newsTags != NULL && $newsAuthor != NULL && $newsSEOurl != NULL) {
					
					$newsSEOurl = str_replace(' ', '-', $newsSEOurl);
					$newsSEOurl = strtolower($newsSEOurl);
					$newsSEOurl = $newsSEOurl.".html";
					
						$this->model->addArticle($newsName, $newsTitle, $newsText, $newsTags, $newsAuthor, $newsDate, $newsSEOurl);
                        if (!mysql_error()) {
                            header('Location: ../index');
                        } else {
							$this->view->loadTemplate('errors/invalidInput', 1);
                        }
                    } else {
						$this->view->loadTemplate('errors/emptyInput', 1);
                    }
                } else {
					$this->view->loadTemplate('home/add', 1);
				}
            }
        }
    }

    public function delArticle($deleteID) {
        if (Session::getSess('userType') == BASH_ACCESS_TYPE) {
            $this->loadModel('home');
			$deleteID = isset($deleteID) ? tdsEsc($deleteID): null;
			if($deleteID > 0 || $deleteID != 0 || $deleteID != null) {
				$info = isset($this->config) ? $this->config : null;
				$this->view->dataSetter($info);
				$this->id['deleteID'] = $deleteID;
				$this->view->data[] = $this->id;
				$this->view->loadTemplate('home/confirmDelete', 1);
			} else {
				require '../../controllers/error_handler.php';
				$controller = new Error_Handler();
				$controller->error();
			}
        }
    }
	
	public function confirmDelete($deleteID) {
		$this->loadModel('home');
		$this->query = $this->model->delete(MB_NEWS, 'newsID', $deleteID);
		header('Location: ../../index');
	}
	
    public function editArticle($newsID) {
        if (Session::getSess('userType') == BASH_ACCESS_TYPE) {
		
			$this->loadModel('home');
			$editButton = isset($_POST['edit']) ? tdsEsc($_POST['edit']) : null;
			$newsID = isset($newsID) ? tdsEsc($newsID) : null;
			
				$info = isset($this->config) ? $this->config : null;
				$this->view->dataSetter($info);
				
			if ($editButton != NULL && $newsID != NULL) {
				$newsName = isset($_POST['newsName'])? tdsEsc($_POST['newsName']) : null;
				$newsTitle = isset($_POST['newsTitle'])? tdsEsc($_POST['newsTitle']) : null;
				$newsSEOurl = isset($_POST['newsSEOurl'])? tdsEsc($_POST['newsSEOurl']) : null;
				$newsText = isset($_POST['newsText'])? tdsEsc($_POST['newsText']) : null;
				$newsTags = isset($_POST['newsTags'])? tdsEsc($_POST['newsTags']) : null;
				$updateDate = time();
				 if ($newsName != NULL && $newsTitle != NULL && $newsText != NULL && $newsTags != NULL && $newsSEOurl != NULL) {
					
					$newsSEOurl = str_replace(' ', '-', $newsSEOurl);
					$newsSEOurl = strtolower($newsSEOurl);
					$newsSEOurl = $newsSEOurl.".html";
					$this->model->editArticle($newsName, $newsText, $newsTitle, $newsTags, $newsSEOurl, $updateDate, $newsID);
					
					if (!mysql_error()) {
						header('Location: ../../index');
					} else {
						$this->view->loadTemplate('errors/invalidInput', 1);
					}
				} else {
					$this->view->loadTemplate('errors/emptyInput', 1);
				}
			} elseif($newsID > 0) {
				 
				$this->qEditForm = $this->model->selectData('newsID', $newsID);
				while ($editData = sqlFetchRow($this->qEditForm)) {
					$this->editNewsData['newsID'] = $editData['newsID'];
					$this->editNewsData['newsName'] = $editData['newsName'];
					$this->editNewsData['newsText'] = $editData['newsText'];
					$this->editNewsData['newsTags'] = $editData['newsTags'];
					$this->editNewsData['newsTitle'] = $editData['newsTitle'];
					$this->editNewsData['newsSEOurl'] = $editData['newsSEOurl'];
					$this->editNewsData['MAIN_PATH'] = $info['BASE_URL'];
					$this->view->setEditData[] = $this->editNewsData;
				}
				$this->view->loadTemplate('home/edit', 1);
			} else {
				header('Location: ../../index');
			}
        }
    }

	public function viewArticle($seoURL) {
		$this->loadModel('home');
		$seoURL = isset($seoURL) ? tdsEsc($seoURL) : null;
		$seoURL = preg_match("/.html/", $seoURL) ? $seoURL : null;
		
		if ($seoURL != NULL) {
			$info = isset($this->config) ? $this->config : null;
			$this->view->dataSetter($info);
			
			$this->getArticle = $this->model->selectData('newsSEOurl', $seoURL);
			while ($row = sqlFetchRow($this->getArticle)) {
				$this->getNews['newsID'] = $row['newsID'];
				$this->getNews['newsName'] = $row['newsName'];
				$this->getNews['newsTitle'] = $row['newsTitle'];
				$this->getNews['newsText'] = bbcodeParser($row['newsText']);
				$this->getNews['newsAuthor'] = $row['newsAuthor'];
				$this->getNews['newsDate'] = $row['newsDate'];
				$this->getNews['newsTags'] = $row['newsTags'];
				$this->getNews['newsSEOurl'] = $row['newsSEOurl'];
				$this->getNews['MAIN_PATH'] = $info['BASE_URL'];
				if(mysql_num_rows($this->getArticle) != 0) {
					$this->getNews['exist'] = 1;
				}
				$this->view->newsView[] = $this->getNews;
			}
			$this->view->loadTemplate('home/viewArticle', 2);
			
			$moreOpenGraph = '
			<meta property="og:article:author" content="'. $this->getNews['newsAuthor'] .'" />
			<meta property="og:article:tag" content="'. $this->getNews['newsTags'] .'" />
			';
			
			$this->view->assign('TITLE',$this->getNews['newsName'].' - '.$info['OG_SITE_NAME']);
			$this->view->assign('DESC',$this->getNews['newsTitle']);
			$this->view->assign('KEYWORDS',$this->getNews['newsTags']);
			
			$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
			$this->view->assign('OG_TYPE','article');
			$this->view->assign('OG_TITLE',$this->getNews['newsName']);
			
			$this->view->assign('CANONICAL',$info['BASE_URL'].'home/viewArticle/'.$seoURL);
			$this->view->assign('MAIN_PATH',$info['BASE_URL']);
			
			$this->view->assign('MIDDLE',$this->view->loadLiaSlider());
			
			$this->view->assign('COPYRIGHT',$info['DOMAIN']);
			$this->view->assign('ROBOTS',$info['ROBOTS']);
			$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
			$this->view->assign('MORE_OPG',$moreOpenGraph);
			$this->view->endLoad();
		} else {
			header('Location: ../../index');
		}
	}
	
	public function maxNews() {
		$this->query = $this->model->cntNews();
		$maxNewsRows = sqlFetchRow($this->query);
		return $maxNewsRows['allRows'];
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