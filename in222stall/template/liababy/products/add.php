<?php
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

<section>
	<h3>Добавяне на продукт</h3>
	<ul>
		<li>
			<div class="article-item">
				<form action="../products/add" method="post">
					<p>
					Product Name: <input type="text" name="productName" /><br/>
					SEO Url: <input type="text" name="productSEOurl" /><br/>
					Product Title: <input type="text" name="productTitle" /><br/>
					Product Tags: <input type="text" name="productTags" /><br/>
					Product Model: <input type="text" name="productModel" /><br/>
					Product Price: <input type="text" name="productPrice" /><br/>
					Units: <input type="text" name="productUnits" /><br/>
					Units Per Кашон: <input type="text" name="productUnitsIn" /><br/>
					Units Per Pack: <input type="text" name="productUnitsInPack" /><br/>
					Content: <textarea name="productDesc"></textarea><br/>
					<input type="submit" class="button" name="addProduct" value="Добави" />
						
					</p>	
				</form>
			</div>
		</li>
	</ul>
 </section>
