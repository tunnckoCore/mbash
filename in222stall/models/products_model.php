<?php
/**
 * @file products_model.php
 * @brief Martonbash 'products' controller model
 * @author MartonBash Development
 * @version 1.13d
 * @last update 11 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Products_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

	public function selectData($INDB, $selected, $all = false) {
		if($all === false) {
			return $this->db->runQuery('SELECT * FROM ' . MB_PRODUCTS . ' WHERE '. $INDB .' = "' . $selected . '"');
		} else {
			return $this->db->runQuery('SELECT '. $all .' FROM ' . MB_PRODUCTS . ' WHERE '. $INDB .' = "' . $selected . '"');
		}
	}
	
    public function deleteProduct($id) {
        return $this->db->runQuery('DELETE FROM ' . MB_PRODUCTS . ' WHERE productID = ' . $id);
    }

    public function addProduct($productName, $productTitle, $productDesc, $productSEOurl, $productTags, $productModel, $productPrice, $productUnits, $productUnitsIn, $productUnitsInPack) {
        return $this->db->runQuery("INSERT INTO " . MB_PRODUCTS . " (productName, productTitle, productDesc, productSEOurl, productTags, productModel, productPrice, productUnits, productUnitsIn, productUnitsInPack) VALUES ('$productName', '$productTitle', '$productDesc', '$productSEOurl', '$productTags', '$productModel', '$productPrice', '$productUnits', '$productUnitsIn', '$productUnitsInPack')");
		
    }

    public function editProduct($productName, $productTitle, $productDesc, $productSEOurl, $productTags, $productModel, $productPrice, $productUnits, $productUnitsIn, $productUnitsInPack, $id) {
        return $this->db->runQuery("UPDATE " . MB_PRODUCTS . "
SET productName = '$productName', productTitle = '$productTitle', productDesc = '$productDesc', productSEOurl = '$productSEOurl', productTags = '$productTags', productModel = '$productModel', productPrice = '$productPrice', productUnits = '$productUnits', productUnitsIn = '$productUnitsIn', productUnitsInPack = '$productUnitsInPack' WHERE productID = '$id'");
    }

	public function cntProducts() {
		return $this->db->runQuery("SELECT COUNT(`productID`) AS total FROM `". MB_PRODUCTS."`");
	}
	
	
	/* get products data */
	public function getProducts($startpoint, $max) {
		 return $this->db->runQuery("SELECT * FROM " . MB_PRODUCTS . " ORDER BY productID DESC LIMIT {$startpoint},{$max}");
	}
}