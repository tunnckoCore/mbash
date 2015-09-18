<?php
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

<section>
	<h3>Добавяне на новина</h3>
	<ul>
		<li>
			<div class="article-item">
				<form action="<?php
					foreach($this->data as $key => $value) {
						echo $value['MAIN_PATH'];
					}
				?>home/addNew" method="post">
					<p>
						<label>Заглавие </label><input type="text" name="newsName" /><br/>
						<label>hover title</label><input type="text" name="newsTitle" /><br/>
						<label>SEO Url</label><input type="text" name="newsSEOurl" /><br/>
						<label>Тагове</label><input type="text" name="newsTags" /><br/>
						<label>Съдържание</label><textarea name="newsText"></textarea><br/><br/>
						<input type="submit" class="button" name="add" value="Добави!" />
					</p>	
				</form>
			</div>
		</li>
	</ul>
 </section>
