<h2>Последни 15 потребителя</h2>
			<div id="userTable">
<?php

foreach ($this->usersData as $k => $members) {
	if($members['noMembers'] != 1) {
		?>
			<div class="memberRow">
				<a href="<?php echo $members['MAIN_PATH']; ?>user/viewProfile/<?php 
							$userName = $members['userNameDisplay'];
							$userName = str_replace(' ', '-', $userName);
							$userName = $userName.".html";
							echo $userName;
				
				?>" title="<?php
					echo $members['userNameDisplay']; 
				?> - преглед на профила">
				<div class="userName"><?php echo $members['userNameDisplay']; ?></div>
				</a>
				<div class="userEmail"><?php echo $members['userEmail']; ?></div>
				<div class="userGroup">
				<?	
					if($members['userType'] == 3) {
						echo "Администратор";
					} else {
						echo "Потребител";
					}
				?>
				</div>
				<div class="clear"></div>
			</div>
		
		<?php
    } else {
		echo 'Няма потребители';
    }
}
?>
</div>
