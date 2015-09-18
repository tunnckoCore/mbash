<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

if(isset($this->profileView)) {
	if(is_array($this->profileView)) {
		foreach ($this->profileView as $k => $profile) {
			if(isset($profile['exist'])) {
				?>
						<div class="grid_8 mb_10 radius_5_all">
							<div class="grid_up hr light bold500 radius_5_top textcenter"><h1>Преглед на потребител 
								<?php echo $profile['userNameDisplay']; ?></h1>
							</div>
							<div class="grid_bottom pall_10">
								<div class="grid_7_item_1 cleaner border1 item pall_5 pl_10 border">
									<span class="boldtext"><?php echo $profile['userNameDisplay']; ?></span>
								</div>
								<div class="grid_7_item_1 cleaner border1 item pall_5 pl_10 border">
									<span class="boldtext"><?php echo $profile['userEmail']; ?></span>
								</div>
								<div class="grid_7_item_1 cleaner border1 item pall_5 pl_10 border">
									<span class="boldtext">
									<?php 
										if($profile['userLastLogout'] == NULL) {
											echo "влизал е само веднъж";
										} else {
											echo "за последно е видян на ".date("j.m.Y в H:i:s", $profile['userLastLogout']);
										}
									?>
									</span>
								</div>
								<div class="grid_7_item_1 cleaner border1 item pall_5 pl_10 border">
									<span class="boldtext">
									<?php
									if($profile['userType'] == 3) {
										echo "Администратор";
									} else {
										echo "Потребител";
									}
									?>
									</span>
								</div>
							</div>
						</div>
						<div class="grid_6 mb_10 radius_5_all">
							<div class="grid_up hr light bold500 radius_5_top textcenter"><h1>"За Мен" от <?php echo $profile['userNameDisplay']; ?></h1></div>
							<div class="grid_bottom pall_20 news">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel porta erat. Quisque sit amet risus at odio pellentesque sollicitudin. Proin suscipit molestie facilisis. Aenean vel massa magna. Proin nec lacinia augue. Mauris venenatis libero nec odio viverra consequat.</p>
								<div class="border1 info pall_10 mt_20 radius_5_all border">Last update: 26.09.2012</div>
								
							</div>
						</div>
				<?php
			}
		}
	}
}
?>