<?php
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

	<section>
		<h3>Редактиране на новина</h3>
		<ul>
			<li>
				<div class="article-item">
<?php

foreach ($this->setEditData as $k => $val) {
	$productSEOurl = str_replace("-", " ", $val['productSEOurl']);
	$productSEO = str_replace(".html", "", $productSEOurl);

    echo '<form action="'.$val['MAIN_PATH'].'products/edit/' . $val['productID'] . '" method="post">
    <p>
        Product Name: <input type="text" name="productName" value="' . $val['productName'] . '" /><br/>
        SEO Url: <input type="text" name="productSEOurl" value="' . $productSEO . '" /><br/>
        Product Title: <input type="text" name="productTitle" value="' . $val['productTitle'] . '" /><br/>
        Product Tags: <input type="text" name="productTags" value="' . $val['productTags'] . '" /><br/>
        Product Model: <input type="text" name="productModel" value="' . $val['productModel'] . '" /><br/>
        Product Price: <input type="text" name="productPrice" value="' . $val['productPrice'] . '" /><br/>
        Units: <input type="text" name="productUnits" value="' . $val['productUnits'] . '" /><br/>
        Units Per Кашон: <input type="text" name="productUnitsIn" value="' . $val['productUnitsIn'] . '" /><br/>
        Units Per Pack: <input type="text" name="productUnitsInPack" value="' . $val['productUnitsInPack'] . '" /><br/>
        Content: <textarea name="productDesc">' . $val['productDesc'] . '</textarea><br/>
        <input type="submit" class="button" name="editProduct" value="EDIT" />
    </p>	
</form>';

}
?>
</div>
			</li>
		</ul>
	 </section>