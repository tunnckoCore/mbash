<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

if(is_array($this->profileView)) {
	foreach ($this->profileView as $k => $profile) {
		if(isset($profile['exist'])) {
		
			?>
				
					<div class="grid_8 mb_10 radius_5_all">
						<div class="grid_up hr light bold500 radius_5_top textcenter"><h1>Потребителски настройки</h1></div>
						<div class="grid_bottom pall_10">
							<div class="grid_7_item_1 cleaner border1 item pall_5 pl_10 border">
								<span class="it">
									<a class="boldtext" href="#" title="Търсим си читав партньор">Редактиране</a>
									- Може да сменяте паролата си, името Ви за показване и електронната Ви поща
								</span>
							</div>
							<div class="grid_7_item_2 cleaner border1 item pall_5 pl_10 border">
								<span class="it">
									<a class="boldtext" href="#" title="Търсим си читав партньор">Блокиране</a>
									- Когато пожелаете можете да го активирате. Нужно е да се свържете с администратор.
								</span>
							</div>
							<div class="grid_7_item_3 cleaner border1 item pall_5 pl_10 border">
								<span class="it">
									<a class="boldtext" href="#" title="Търсим си читав партньор">Изтриване на профил</a>
									- След като цъкнете иска за потвържение уникалният Ви номер. Ако е верен - профилът ще бъде изтрит завинаги.
								</span>
							</div>
						</div>
					</div>
					<div class="grid_6 mb_10 radius_5_all">
						<div class="grid_up hr light bold500 radius_5_top textcenter"><h1>"За Мен" от <?php echo $profile['userNameDisplay']; ?></h1></div>
						<div class="grid_bottom pall_20 news">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel porta erat. Quisque sit amet risus at odio pellentesque sollicitudin. Proin suscipit molestie facilisis. Aenean vel massa magna. Proin nec lacinia augue. Mauris venenatis libero nec odio viverra consequat.</p>
							<div class="border1 info pall_10 mt_20 radius_5_all border">Last update: 26.09.2012 / Edit</div>
							
						</div>
					</div>
			
			<?php
		} else {
			return false;
		}
	}
}

?>
