<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

?>
		<div class="grid_4 mb_10 radius_5_all">
			<div class="grid_up hr light bold500 radius_5_top">
			<h1 class="pl_20 textleft">Редактиране на статия</h1>
			</div>
			<div class="grid_bottom pall_20">
			
			<?php
				foreach ($this->setEditData as $k => $val) {
					$newsSEOurl = str_replace("-", " ", $val['newsSEOurl']);
					$newsSEO = str_replace(".html", "", $newsSEOurl);

					echo '<form action="'.$val['MAIN_PATH'].'home/editArticle/' . $val['newsID'] . '" method="post">';
			?>
					<p>
						<table cellpadding="2px" cellspacing="6px">
							<tr>
								<td>Заглавие </td><td><input type="text" name="newsName" value="<?= $val['newsName']; ?>"/></td>
							</tr><tr>
								<td>Описание </td><td><input type="text" name="newsTitle" value="<?= $val['newsTitle']; ?>"/></td>
							</tr><tr>
								<td>SEO Url </td><td><input type="text" name="newsSEOurl" value="<?= $newsSEO ?>"/></td>
							</tr><tr>
								<td>Ключови думи </td><td><input type="text" name="newsTags" value="<?= $val['newsTags']; ?>"/></td>
							</tr><tr>
								<td>Съдържание </td><td><textarea name="newsText" cols="40" rows="10"><?= $val['newsText']; ?>"</textarea></td>
							</tr><tr>
								<td> </td><td><input type="submit" class="button" name="edit" value="Редактиране" /></td>
							</tr>
						</table>
					</p>	
				</form>
			<?php 
				}
			?>
			</div>
		</div>
		