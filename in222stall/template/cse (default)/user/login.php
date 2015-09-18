<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);
		

?>
<section>
	<h3>Вход за потребители</h3>
	<ul>
		<li>
			<div class="article-item">
				<form action="<?php
					foreach($this->data as $key => $value) {
						echo $value['MAIN_PATH'];
					}
				?>user/logIn" method="post">
				<p>
					<label>Потребител:</label> <input type="text" name="userLogin" /><br/>
					<label>Парола:</label> <input type="password" name="userPassword" /><br/><br/>
					<input type="submit" class="button" name="login" value="Влез" />
				</p>	
				</form>

			</div>
		</li>
	</ul>
</section>