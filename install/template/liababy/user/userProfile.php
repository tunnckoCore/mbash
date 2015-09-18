<?php
if(defined('CERR_HANDLER')) error_reporting(-1);


if(is_array($this->profileView)) {
	foreach ($this->profileView as $k => $profile) {
		if(isset($profile['exist'])) {
			?>
			<section>
				<h3>Потребител <?php echo $profile['userNameDisplay']; ?></h3>
				<ul>
					<li>
						<div class="article-item">
							<p>Името Ви за вход в системата е <?php echo $profile['userLogin']; ?></p>
							<p>Име, което се вижда е <?php echo $profile['userNameDisplay']; ?></p>
							<p>Регистрирани сте с Email <?php echo $profile['userEmail']; ?></p>
							<p>Паролата Ви е <?php echo Session::getSess('userPassword'); ?></p>
							<p>Последното Ви влизане беше в 
							<?php 
								if($profile['userLastLogout'] == NULL) {
									echo date("H:i:s на j.m.Y", Session::getSess('userLogInTime'));
								} else {
									echo date("H:i:s на j.m.Y", $profile['userLastLogout']);
								}
							?>
							</p>
							<p>Вие влезнахте в <?php echo date("H:i:s на j.m.Y", Session::getSess('userLogInTime')); ?></p>
							<p>Вашият уникален номер е <?php echo $profile['userUniqueID']; ?></p>
							<p>Вашият ранг в сайта е 
							<?php
								if($profile['userType'] == 3) {
									echo "Администратор";
								} else {
									echo "Потребител";
								}
							?>
							</p>
						</div>
					</li>
				</ul>
			</section>
			
			<?php
		} else {
			return false;
		}
	}
}

?>