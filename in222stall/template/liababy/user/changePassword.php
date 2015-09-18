<section>
	<h3>Смяна на парола</h3>
	<ul>
		<li>
			<div class="article-item">
				<form action="<?php echo BASE_URL; ?>user/changePassword" method="post">
					<p>
						<label>Сегашна Парола:</label> <input type="password" name="oldpassword" /><br/>
						<label>Нова Парола:</label> <input type="text" name="password" /><br/>
						<label>Повтори парола:</label> <input type="password" name="repassword" /><br/><br/>
						<input type="submit" class="button" name="changePassword" value="Смяна" />
					<p>
				</form>
			</div>
		</li>
	</ul>
</section>