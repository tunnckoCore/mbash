<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

<section>
	<h3>Регистрация</h3>
	<ul>
		<li>
			<div class="article-item">
				<form action="<?php
					foreach($this->data as $key => $value) {
						echo $value['MAIN_PATH'];
					}
				?>user/regUser" method="post">
				<p>
					<label>Потребител за вход:</label> <input type="text" name="regLoginName" /><br/>
					<label>Име, което ще се вижда:</label> <input type="text" name="regDisplayName" /><br/>
					<label>Емайл:</label> <input type="text" name="regEmail" /><br/>
					<label>Парола:</label> <input type="text" name="regPass" /><br/>
					<label>Повтори Парола:</label> <input type="password" name="regRePass" /><br/><br/>
					<input type="submit" class="button" name="register" value="Регистрация" />
				<p>
				</form>
			</div>
		</li>
	</ul>
 </section>