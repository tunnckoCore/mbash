<?php
if(defined('CERR_HANDLER')) error_reporting(-1);

if(is_array($this->setNewsData)) {

	echo '<article class="lastNews">
			<h3>Последни новини</h3>
			<ul>';
				
	foreach ($this->setNewsData as $key => $value) {
		if (!isset($value['noNews'])) {
		$this->newsMax = $value['newsMax'];
		$this->PER_PAGE = $value['PER_PAGE'];
		
		/* $BGTIME = (60 * 60) * 7; */
		
			if(isset($_GET['test']) || !isset($_GET['test'])) {
			$timeLine = $value['newsDate']; //25200 = 7h
			$tags = explode("," , $value['newsTags']);
			
			
			echo '<li>
					<div class="article-item">
						<h2><a href="'.$value['MAIN_PATH'].'home/viewArticle/' . $value['newsSEOurl'] . '" title="' . $value['newsTitle'] . '">' . $value['newsName'] . '</a></h2>';
						
					echo '
						<p>' . nl2br($value['newsText']);
				echo '</p>';
				
				echo '<div class="opt">';
						if(Session::getSess('lia_logged') == true
						&& Session::getSess('memberType') == BASH_ACCESS_TYPE
						/* Session::getSess('memberLogin') == BASH_ACCESS_LOGIN */) {
				echo '<a href="'.$value['MAIN_PATH'].'home/delNew/' . $value['newsID'] . '" title="Изтрии новината">
					Изтрий 
					</a>';
				echo '<a href="'.$value['MAIN_PATH'].'home/editNew/' . $value['newsID'] . '" title="Редактирай новината">
					Редактирай
					</a></div><div style="clear:both;"></div>';
			}
			echo '
					<span class="infoDate"> От <span class="bold">'.$value['newsAuthor'].'</span> на ' . date("j.m, H:iч.", $timeLine) . '</span>
					<span class="infoTags"> Тагове: ';
							
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
						
			echo '</span>';
			
			
				
					
			echo	'</div>
				  </li>';
						
			
			}
		}
	}
		echo '</ul>';
			
		if($this->newsMax > 0) {
			$paging = new Pag($this->PER_PAGE, $this->newsMax);
			echo $paging->output;
		}
		echo '</article>';
	
	
}

?>