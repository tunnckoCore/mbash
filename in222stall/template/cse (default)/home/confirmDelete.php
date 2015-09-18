<?php
/**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
	if(defined('CERR_HANDLER')) error_reporting(-1);
?>

		<div class="grid_4 mb_10 radius_5_all">
			<div class="grid_up hr light bold500 radius_5_top">
			<h1 class="pl_20 textleft">Изтриване на статия</h1>
			</div>
			<div class="grid_bottom pall_20">
			<p>
				<div class="boldtext">Сигурен ли сте, че искате да изтриете статията?</div>
				<div class="pl_20 pt_10">
			<?php
				foreach ($this->data as $k => $web) {
					echo '<a href="../confirmDelete/'.$web['deleteID'].'" class="adm">Да, потвърждавам</a>';
				}
			?> / <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="adm">Не</a>
				</div>
			</p>
			</div>
		</div>