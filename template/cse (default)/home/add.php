<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

		<div class="grid_4 mb_10 radius_5_all">
			<div class="grid_up hr light bold500 radius_5_top">
			<h1 class="pl_20 textleft">Добавяне на нова статия</h1>
			</div>
			<div class="grid_bottom pall_20">
			
				<form action="<?php
					echo $this->dataInfo['BASE_URL'];
				?>home/addArticle" method="post">
					<p>
						<table cellpadding="2px" cellspacing="6px">
							<tr>
								<td>Заглавие </td><td><input type="text" name="newsName" /></td>
							</tr><tr>
								<td>Описание </td><td><input type="text" name="newsTitle" /></td>
							</tr><tr>
								<td>SEO Url </td><td><input type="text" name="newsSEOurl" /></td>
							</tr><tr>
								<td>Ключови думи </td><td><input type="text" name="newsTags" /></td>
							</tr><tr>
								<td>Съдържание </td><td><textarea name="newsText" cols="40" rows="10"></textarea></td>
							</tr><tr>
								<td> </td><td><input type="submit" class="button" name="add" value="Добави" /></td>
							</tr>
						</table>
					</p>	
				</form>
			</div>
		</div>
