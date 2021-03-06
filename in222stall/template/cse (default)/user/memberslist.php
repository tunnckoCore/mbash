<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

		<div class="grid_4 mb_10 radius_5_all">
			<div class="grid_up hr light bold500 radius_5_top">
			<h1 class="pl_20 textleft">Последно регистрирани</h1>
			</div>
			<div class="grid_bottom pall_20">
			
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
