<?php
if(defined('CERR_HANDLER')) error_reporting(-1);


if(is_array($this->dataProdView)) {
	foreach ($this->dataProdView as $k => $article) {
		if(!isset($article['noProducts'])) {
		$tags = explode("," , $article['productTags']);
			?>
			
<section>
	<h3><a title="<?php echo $article['productTitle']; ?>"><?php echo $article['productName']; ?></a></h3>
	<ul>
		<li>
			<div class="article-item">
			<span class="infoTags"> Тагове: 				
				<?php
					$limit = count($tags);
					
					for($i = 0; $i < $limit; $i++)
					{
						if($i+1 == $limit) {
							$r = explode(",",$tags[$limit-1]);
							echo "<strong>".$r[0]."</strong>";
						} else {
							echo "<strong>".$tags[$i]."</strong> , ";
						}
					}
				?>
			</span>
			<p><br/><br/>
			<?php echo nl2br($article['productDesc']); ?></p>
			<div class="opt">
			<?php
				if(Session::getSess('logged') == true
				&& Session::getSess('userType') == BASH_ACCESS_TYPE
				/* Session::getSess('userLogin') == BASH_ACCESS_LOGIN */)
				{
			?>
			<a href="<?php echo $article['MAIN_PATH']; ?>products/delete/<?php echo $article['productID']; ?>" title="Изтрии новината">Изтрий</a>
			<a href="<?php echo $article['MAIN_PATH']; ?>products/edit/<?php echo $article['productID']; ?>" title="Редактирай новината">Редактирай</a>
			</div><div style="clear:both;"></div>
			<?php 
				}
			?>
			
			
			</div>
		</li>
	</ul>
</section>
			
			<?php
		} else {
			echo "patka";
		}
	}
}

?>