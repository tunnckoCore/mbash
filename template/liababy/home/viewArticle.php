<?php
if(defined('CERR_HANDLER')) error_reporting(-1);


if(is_array($this->newsView)) {
	foreach ($this->newsView as $k => $article) {
		if(isset($article['exist'])) {
		$tags = explode("," , $article['newsTags']);
			?>
			
<section>
	<h3><a title="<?php echo $article['newsTitle']; ?>"><?php echo $article['newsName']; ?></a></h3>
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
			<?php echo nl2br($article['newsText']); ?></p>
			<div class="opt">
			<?php
				if(Session::getSess('lia_logged') == true
				&& Session::getSess('memberType') == BASH_ACCESS_TYPE
				/* Session::getSess('memberLogin') == BASH_ACCESS_LOGIN */)
				{
			?>
			<a href="<?php echo $article['MAIN_PATH']; ?>home/delNew/<?php echo $article['newsID']; ?>" title="Изтрии новината">Изтрий</a>
			<a href="<?php echo $article['MAIN_PATH']; ?>home/editNew/<?php echo $article['newsID']; ?>" title="Редактирай новината">Редактирай</a>
			</div><div style="clear:both;"></div>
			<?php 
				}
			?>
			<span class="infoDate"> От <span class="bold"><?php echo $article['newsAuthor']; ?></span> на 
			<?php echo date("j.m, H:iч.", $article['newsDate']); ?></span>
			
			</div>
		</li>
	</ul>
</section>
			
			<?php
		} else {
			return false;
		}
	}
}

?>