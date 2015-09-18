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
							<p>Display Name: <?php echo $profile['userNameDisplay']; ?></p>
							<p>Email: <?php echo $profile['userEmail']; ?></p>
							<p>
							<?php 
								if($profile['userLastLogout'] == NULL) {
									echo "влизал е само веднъж";
								} else {
									echo "За последно е видян на ".date("j.m.Y в H:i:s", $profile['userLastLogout']);
								}
							?>
							</p>
							<p>Ранг: 
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