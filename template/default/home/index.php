<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

if(is_array($this->setNewsData)) {
?>
					<div class="grid_up grid_0 light bold500 radius_5_all mb_10 textcenter">
						<?php 
							foreach ($this->uniq as $k => $v) {
								echo $v['randUID'];
							}
							
						?>
					</div>

<?
	
				
	foreach ($this->setNewsData as $key => $value) {
		if (!isset($value['noNews'])) {
		$this->newsMax = $value['newsMax'];
		$this->PER_PAGE = $value['PER_PAGE'];
		
		
		/* $BGTIME = (60 * 60) * 7; */
		
			if(isset($_GET['test']) || !isset($_GET['test'])) {
			$timeLine = $value['newsDate']; //25200 = 7h
			$tags = explode("," , $value['newsTags']);
		?>
						
					<div class="grid_4 mb_10 radius_5_all">
						
						<div class="grid_up hr light bold500 radius_5_top">
						<h1>
						<?php
			echo '
	<a class="pl_20 pr_10 textleft" href="'.$value['MAIN_PATH'].'home/viewArticle/' . $value['newsSEOurl'] . '" title="' . $value['newsTitle'] . '">' . $value['newsName'] . '</a>
				';		?></h1>
						</div>
						<div class="grid_bottom pall_20">
							<p class="pb_20">
							<?php 
								$text = wrap(400, $value['newsText'], $value['MAIN_PATH'].'home/viewArticle/'.$value['newsSEOurl']);
								echo nl2br($text);
							?>
							
							</p>
							<div class="cleaner"></div>
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
								От <span class="boldtext"><?php echo $value['newsAuthor'];?></span> на <?php echo date("j.m, H:iч.", $timeLine);?>
							
<?php
if(Session::getSess('logged') == true && Session::getSess('userType') == BASH_ACCESS_TYPE
/* Session::getSess('userLogin') == BASH_ACCESS_LOGIN */ )
{
	echo '
			<a href="'.$value['MAIN_PATH'].'home/delArticle/' . $value['newsID'] . '" title="Изтрии новината" class="adm">Изтрий</a> &bull; 
			<a href="'.$value['MAIN_PATH'].'home/editArticle/' . $value['newsID'] . '" title="Редактирай новината" class="adm">Редактирай</a> &bull; 
			<a href="'.$value['MAIN_PATH'].'home/addArticle/" title="Добавяне на новина" class="adm">Добави</a>
		';
} ?>
							</p>
						</div>
					</div>
						
		
		<?php
			
			}
		}
	}
	
		if($this->newsMax > 0) {
			$paging = new Pag($this->PER_PAGE, $this->newsMax);
			echo $paging->output;
		}
	
	
}
	

?>