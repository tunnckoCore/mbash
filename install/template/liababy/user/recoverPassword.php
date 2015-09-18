<section>
	<h3>Възтановяване на парола</h3>
	<ul>
		<li>
			<div class="article-item">
				<form action="<?php echo BASE_URL; ?>user/recoverPassword" method="post">
					<p>
						<label>Вашият E-mail:</label> <input type="text" name="userEmail" /><br/><br/>
						<input type="submit" class="button" name="submitRecoverPassword" value="Смяна" />
					<p>
				</form>
			</div>
		</li>
	</ul>
</section>