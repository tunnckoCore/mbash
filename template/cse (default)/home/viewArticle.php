<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);


if(is_array($this->newsView)) {
	foreach ($this->newsView as $k => $article) {
		if(isset($article['exist'])) {
		$tags = explode("," , $article['newsTags']);
			?>
			
				
					<div class="grid_4 mb_10 radius_5_all">
						<div class="grid_up hr light bold500 radius_5_top">
						<h1>
						<?php
			echo '
<a class="pl_20 pr_10 textleft" href="'.$article['MAIN_PATH'].'home/viewArticle/' . $article['newsSEOurl'] . '" title="' . $article['newsTitle'] . '">' . $article['newsName'] . '</a>
				';		?></h1>
						</div>
						<div class="grid_bottom pall_20">
							<p class="pb_20"><?php echo nl2br($article['newsText']); ?></p>
							<p class="border1 info pall_5 radius_5_top border"><span class="boldtext">Ключови думи:</span>
							<?php
								$limit = count($tags);
								
								for($i = 0; $i < $limit; $i++)
								{
									if($i+1 == $limit) {
										$r = explode(",",$tags[$limit-1]);
										echo '<strong class="it normal">'.$r[0].'</strong>';
									} else {
										echo '<strong class="it normal">'.$tags[$i].'</strong> , ';
									}
								}
							?>
							</p>
							<p class="border1 info pall_5 radius_5_bottom border">
				От <span class="boldtext"><?php echo $article['newsAuthor'];?></span> на <?php echo date("j.m, H:iч.", $article['newsDate']);?>
							
<?php
if(Session::getSess('logged') == true && Session::getSess('userType') == BASH_ACCESS_TYPE
/* Session::getSess('userLogin') == BASH_ACCESS_LOGIN */ )
{
	echo '
		<a href="'.$article['MAIN_PATH'].'home/delArticle/' . $article['newsID'] . '" title="Изтрии новината" class="adm">Изтрий</a> &bull; 
		<a href="'.$article['MAIN_PATH'].'home/editArticle/' . $article['newsID'] . '" title="Редактирай новината" class="adm">Редактирай</a> &bull; 
		<a href="'.$article['MAIN_PATH'].'home/addArticle/" title="Добавяне на новина" class="adm">Добави</a>
		';
} ?>
							</p>
						</div>
					</div>
			<?php
		} else {
			return false;
		}
	}
}

?>