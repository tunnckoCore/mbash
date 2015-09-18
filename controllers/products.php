<?php
/**
 * @file products.php
 * @brief List with products name, price, units and etc.. Adding new product, delete, edit etc...
 * @author MartonBash Development
 * @version 8.14d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Products extends baseController implements iMartonBashControllers {

	public function __construct() {
        parent::__construct();
    }

	public function index() {
		$this->loadModel('products');

		$info = isset($this->config) ? $this->config : null;
		$this->view->dataSetter($info);

		$paging = new Pag(15, 15);

		$this->countProducts = $this->model->cntProducts();
		$total = sqlFetchRow($this->countProducts);

        $this->query = $this->model->getProducts($paging->limit['first'], $paging->limit['second']);
        while ($row = sqlFetchRow($this->query)) {
            $this->getProdData['productID'] = $row['productID'];
			$this->getProdData['productName'] = $row['productName'];
			$this->getProdData['productTitle'] = $row['productTitle'];
			$this->getProdData['productSEOurl'] = $row['productSEOurl'];
			$this->getProdData['productTags'] = $row['productTags'];
			$this->getProdData['productModel'] = $row['productModel'];
			$this->getProdData['productPrice'] = $row['productPrice'];
			$this->getProdData['productUnits'] = $row['productUnits'];
			$this->getProdData['productUnitsIn'] = $row['productUnitsIn'];
			$this->getProdData['productUnitsInPack'] = $row['productUnitsInPack'];
			$this->getProdData['MAIN_PATH'] = $info['BASE_URL'];
			$this->getProdData['productTotal'] = $total['total'];
            $this->getProdData['productDesc'] = bbcodeParser($row['productDesc']);;
			if (mysql_num_rows($this->query) == 0) {
				$this->getProdData['noProducts'] = 1;
			}
			$this->view->setProductsData[] = $this->getProdData;
        }
		/* Load Template
		**/
			$info = isset($this->config) ? $this->config : null;
			$this->view->dataSetter($info);

			$this->view->loadTemplate('products/index', 2);

			$moreOpenGraph = '';
			$middle = "<article class='uniqueBody'><h2>Повече за LiaBaby.com</h2>
			<p>Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове.</p></article>";

			$this->view->assign('TITLE','Продуктов каталог - '.$info['TITLE']);
			$this->view->assign('DESC','Каталог на продукти предлагани от '.$info['TITLE'].'. '.$info['DESC']);
			$this->view->assign('KEYWORDS',$info['KEYWORDS']);

			$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
			$this->view->assign('OG_TYPE','website');
			$this->view->assign('OG_TITLE','Продуктов каталог - '.$info['TITLE']);

			$this->view->assign('CANONICAL',$info['BASE_URL'].'products/index');
			$this->view->assign('MAIN_PATH',$info['BASE_URL']);

			$this->view->assign('MIDDLE',$middle);

			$this->view->assign('COPYRIGHT',$info['DOMAIN']);
			$this->view->assign('ROBOTS',$info['ROBOTS']);
			$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
			$this->view->assign('MORE_OPG',$moreOpenGraph);
			$this->view->endLoad();
    }

	public function add() {
		if (Session::getSess('logged') == false) {
			header('Location: ../index');
		} else {
			if (Session::getSess('userType') != BASH_ACCESS_TYPE) {
				header('Location: ../../index');
			} else {

				$this->loadModel('products');
				$addButton = isset($_POST['addProduct']) ? tdsEsc($_POST['addProduct']) : null;
				$add_escID = isset($addButton) ? tdsEsc($addButton) : null;

					$info = isset($this->config) ? $this->config : null;
					$this->view->dataSetter($info);

				if ($addButton != NULL) {
					$productName   = isset($_POST['productName'])   ? tdsEsc($_POST['productName'])   : null;
					$productTitle  = isset($_POST['productTitle'])  ? tdsEsc($_POST['productTitle'])  : null;
					$productDesc   = isset($_POST['productDesc'])   ? tdsEsc($_POST['productDesc'])   : null;
					$productSEOurl = isset($_POST['productSEOurl']) ? tdsEsc($_POST['productSEOurl']) : null;
					$productTags   = isset($_POST['productTags'])   ? tdsEsc($_POST['productTags'])   : null;
					$productModel  = isset($_POST['productModel'])  ? tdsEsc($_POST['productModel'])  : null;
					$productPrice  = isset($_POST['productPrice'])  ? tdsEsc($_POST['productPrice'])  : null;
					$productUnits  = isset($_POST['productUnits'])  ? tdsEsc($_POST['productUnits'])  : null;
					$productUnitsIn  = isset($_POST['productUnitsIn'])  ? tdsEsc($_POST['productUnitsIn'])  : null;
					$productUnitsInPack  = isset($_POST['productUnitsInPack'])  ? tdsEsc($_POST['productUnitsInPack'])  : null;

					 if ($productName != NULL && $productTitle != NULL && $productDesc != NULL && $productSEOurl != NULL && $productTags != NULL && $productModel != NULL && $productPrice != NULL && $productUnits != NULL && $productUnitsIn != NULL && $productUnitsInPack != NULL) {

						$productSEOurl = str_replace(' ', '-', $productSEOurl);
						$productSEOurl = strtolower($productSEOurl);
						$productSEOurl = $productSEOurl.".html";

							$this->model->addProduct($productName, $productTitle, $productDesc, $productSEOurl, $productTags, $productModel, $productPrice, $productUnits, $productUnitsIn, $productUnitsInPack);

						if (!mysql_error()) {
							header('Location: ../');
						} else {
							$this->view->loadTemplate('errors/invalidInput', 1);
						}
					} else {
						$this->view->loadTemplate('errors/emptyInput', 1);
					}
				} else {

					$this->fd = $this->model->selectData('productID', $edit_escID);
					while ($rows = sqlFetchRow($this->fd)) {
						$this->dataAdd['productID'] = $rows['productID'];
						$this->dataAdd['productName'] = $rows['productName'];
						$this->dataAdd['productTitle'] = $rows['productTitle'];
						$this->dataAdd['productDesc'] = $rows['productDesc'];
						$this->dataAdd['productSEOurl'] = $rows['productSEOurl'];
						$this->dataAdd['productTags'] = $rows['productTags'];
						$this->dataAdd['productModel'] = $rows['productModel'];
						$this->dataAdd['productPrice'] = $rows['productPrice'];
						$this->dataAdd['productUnits'] = $rows['productUnits'];
						$this->dataAdd['productUnitsIn'] = $rows['productUnitsIn'];
						$this->dataAdd['productUnitsInPack'] = $rows['productUnitsInPack'];
						$this->dataAdd['MAIN_PATH'] = $this->confInfo['MAIN_PATH'];
						$this->view->setAddData[] = $this->dataAdd;
					}
					$this->view->loadTemplate('products/add', 1);
				}
			}
		}
    }

	public function delete($deleteID) {
        if (Session::getSess('userType') == BASH_ACCESS_TYPE) {
            $this->loadModel('products');
			$deleteID = isset($deleteID) ? tdsEsc($deleteID): null;
			if($deleteID > 0 || $deleteID != 0 || $deleteID != null) {
				$this->query = $this->model->deleteProduct($deleteID);
				header('Location: ../../index');
			} else {
				require '../../controllers/error_handler.php';
				$controller = new Error_Handler();
				$controller->error();
			}
        }
    }

	public function edit($editID) {
        if (Session::getSess('logged') == false) {
			header('Location: ../index');
		} else {
			if (Session::getSess('userType') != BASH_ACCESS_TYPE) {
				header('Location: ../../index');
			} else {

				$this->loadModel('products');
				$editButton = isset($_POST['editProduct']) ? tdsEsc($_POST['editProduct']) : null;
				$edit_escID = isset($editID) ? tdsEsc($editID) : null;

					$info = isset($this->config) ? $this->config : null;
					$this->view->dataSetter($info);

				if ($editButton != NULL && $edit_escID != NULL) {
					$productName   = isset($_POST['productName'])   ? tdsEsc($_POST['productName'])   : null;
					$productTitle  = isset($_POST['productTitle'])  ? tdsEsc($_POST['productTitle'])  : null;
					$productDesc   = isset($_POST['productDesc'])   ? tdsEsc($_POST['productDesc'])   : null;
					$productSEOurl = isset($_POST['productSEOurl']) ? tdsEsc($_POST['productSEOurl']) : null;
					$productTags   = isset($_POST['productTags'])   ? tdsEsc($_POST['productTags'])   : null;
					$productModel  = isset($_POST['productModel'])  ? tdsEsc($_POST['productModel'])  : null;
					$productPrice  = isset($_POST['productPrice'])  ? tdsEsc($_POST['productPrice'])  : null;
					$productUnits  = isset($_POST['productUnits'])  ? tdsEsc($_POST['productUnits'])  : null;
					$productUnitsIn  = isset($_POST['productUnitsIn'])  ? tdsEsc($_POST['productUnitsIn'])  : null;
					$productUnitsInPack  = isset($_POST['productUnitsInPack'])  ? tdsEsc($_POST['productUnitsInPack'])  : null;

					 if ($productName != NULL && $productTitle != NULL && $productDesc != NULL && $productSEOurl != NULL && $productTags != NULL && $productModel != NULL && $productPrice != NULL && $productUnits != NULL && $productUnitsIn != NULL && $productUnitsInPack != NULL) {

						$productSEOurl = str_replace(' ', '-', $productSEOurl);
						$productSEOurl = strtolower($productSEOurl);
						$productSEOurl = $productSEOurl.".html";
							$this->model->editProduct($productName, $productTitle, $productDesc, $productSEOurl, $productTags, $productModel, $productPrice, $productUnits, $productUnitsIn, $productUnitsInPack, $edit_escID);

						if (!mysql_error()) {
							header('Location: ../');
						} else {
							$this->view->loadTemplate('errors/invalidInput', 1);
						}
					} else {
						$this->view->loadTemplate('errors/emptyInput', 1);
					}
				} elseif($edit_escID > 0) {

					$this->fd = $this->model->selectData('productID', $edit_escID);
					while ($rows = sqlFetchRow($this->fd)) {
						$this->editNewsData['productID'] = $rows['productID'];
						$this->editNewsData['productName'] = $rows['productName'];
						$this->editNewsData['productTitle'] = $rows['productTitle'];
						$this->editNewsData['productDesc'] = $rows['productDesc'];
						$this->editNewsData['productSEOurl'] = $rows['productSEOurl'];
						$this->editNewsData['productTags'] = $rows['productTags'];
						$this->editNewsData['productModel'] = $rows['productModel'];
						$this->editNewsData['productPrice'] = $rows['productPrice'];
						$this->editNewsData['productUnits'] = $rows['productUnits'];
						$this->editNewsData['productUnitsIn'] = $rows['productUnitsIn'];
						$this->editNewsData['productUnitsInPack'] = $rows['productUnitsInPack'];
						$this->editNewsData['MAIN_PATH'] = $info['BASE_URL'];
						$this->view->setEditData[] = $this->editNewsData;
					}
					$this->view->loadTemplate('products/edit', 1);
				} else {
					header('Location: ../');
				}
			}
		}
    }

	public function view($seoURL) {
		$this->loadModel('products');
		$seoURL = isset($seoURL) ? tdsEsc($seoURL) : null;
		$seoURL = preg_match("/.html/", $seoURL) ? $seoURL : null;

		if ($seoURL != NULL) {
			$info = isset($this->config) ? $this->config : null;
			$this->view->dataSetter($info);

			$this->getProduct = $this->model->selectData('productSEOurl', $seoURL);
			while ($row = sqlFetchRow($this->getProduct)) {
				$this->viewData['productID'] = $row['productID'];
				$this->viewData['productName'] = $row['productName'];
				$this->viewData['productTitle'] = $row['productTitle'];
				$this->viewData['productSEOurl'] = $row['productSEOurl'];
				$this->viewData['productTags'] = $row['productTags'];
				$this->viewData['productModel'] = $row['productModel'];
				$this->viewData['productPrice'] = $row['productPrice'];
				$this->viewData['productUnits'] = $row['productUnits'];
				$this->viewData['productUnitsIn'] = $row['productUnitsIn'];
				$this->viewData['productUnitsInPack'] = $row['productUnitsInPack'];
				$this->viewData['MAIN_PATH'] = $info['BASE_URL'];
				$this->viewData['productDesc'] = bbcodeParser($row['productDesc']);
				if (mysql_num_rows($this->getProduct) == 0) {
					$this->viewData['noProducts'] = 1;
				}
				$this->view->dataProdView[] = $this->viewData;
			}
			$this->view->loadTemplate('products/view', 2);

			$moreOpenGraph = '';
			$middle = "<article class='uniqueBody'><h2>Информация</h2>
			<p>Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове.</p></article>";

			$this->view->assign('TITLE',$this->viewData['productName'].' - '.$info['OG_SITE_NAME']);
			$this->view->assign('DESC',$this->viewData['productTitle']);
			$this->view->assign('KEYWORDS',$this->viewData['productTags']);

			$this->view->assign('OG_SITE_NAME',$info['OG_SITE_NAME']);
			$this->view->assign('OG_TYPE','article');
			$this->view->assign('OG_TITLE',$this->viewData['productName']);

			$this->view->assign('CANONICAL',$info['BASE_URL'].'products/view'.$seoURL);
			$this->view->assign('MAIN_PATH',$info['BASE_URL']);

			$this->view->assign('MIDDLE',$middle);

			$this->view->assign('COPYRIGHT',$info['DOMAIN']);
			$this->view->assign('ROBOTS',$info['ROBOTS']);
			$this->view->assign('GOOGLEBOT',$info['GOOGLEBOT']);
			$this->view->assign('MORE_OPG',$moreOpenGraph);
			$this->view->endLoad();
		} else {
			header('Location: ../index');
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
