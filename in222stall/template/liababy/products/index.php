<?php
if(defined('CERR_HANDLER')) error_reporting(-1);



				
if(is_array($this->setProductsData)) {

	echo '<article class="lastNews">
			<h3>Продуктов каталог ';
			if(Session::getSess('logged') == true
&& Session::getSess('userType') == BASH_ACCESS_TYPE
/* Session::getSess('userLogin') == BASH_ACCESS_LOGIN */) {
echo " (<a href='products/add' title='Добави нов продукт' style='text-decoration: none;font-size:12;'>добави</a>)";
}
			
	echo '</h3>
			<ul>';
			?>
<table align="center" width="610" style="margin: 20px 0 10px 1px;">
<tr>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>#</b></td>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:10px 2px -5px 2px; text-align:center; font-size:14;'><b>Име на продукта</b></td>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>Цена/бр. <br/>в лева</b></td>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>Бройки<br/> в опаковка</b></td>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>Бройки<br/> в кашон</b></td>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>Кол. <br/>кашони</b></td>
<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>Цена <br/>кашон</b></td>
<?php
if(Session::getSess('logged') == true
&& Session::getSess('userType') == BASH_ACCESS_TYPE
/* Session::getSess('userLogin') == BASH_ACCESS_LOGIN */) {
echo "<td style='border: 1px solid #d0d0d0; background:#f3f3f3; padding:5px 2px; text-align:center; font-size:14;'><b>Опции</b></td>";
}

?>

</tr>
			<?php
	foreach ($this->setProductsData as $key => $das) {
		if (!isset($das['noProducts'])) {
		echo "<li><div class='article-item'>";
					?>
					

					
						<tr>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:left;'>
	<?php echo $das['productID'];?>
</td>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px 20px 5px 10px; text-align:left;'>
	<a href="products/view/<?php echo $das['productSEOurl'];?>" title="<?php echo $das['productTitle'];?>"><?php echo $das['productName'];?></a>
</td>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:center;'>
	<?php echo $das['productPrice'].' лв.';?>
</td>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:center;'>
	<?php echo $das['productUnitsInPack'];?>
</td>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:center;'>
	<?php echo $das['productUnitsIn'];?>
</td>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:center;'>
	<?php echo $das['productUnits'];?>
</td>

<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:center;'>
	<?php echo $das['productPrice'] * $das['productUnitsIn'].' лв.';?>
</td>
						
					<?php
						if(Session::getSess('logged') == true
						&& Session::getSess('userType') == BASH_ACCESS_TYPE
						/* Session::getSess('userLogin') == BASH_ACCESS_LOGIN */) {
						?>
<td style='border: 1px solid #d0d0d0; background:#fafafa; padding:5px; text-align:center;'>						
						<?php
		echo "<a href='{$das['MAIN_PATH']}products/delete/{$das['productID']}' title='Изтрии продукта' style='text-decoration: none;'>Delete</a> /
			<a href='{$das['MAIN_PATH']}products/edit/{$das['productID']}' title='Редактирай продукта' style='text-decoration: none;'>Edit</a></td>";
						}
						?>
						</tr>
						<?php
					
		echo '</div></li>';
		
		}
	}
			
		
		echo '</table></ul></article>';
	
	
}
?>