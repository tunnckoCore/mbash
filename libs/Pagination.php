<?php
/**
 * @file Pagination.php
 * @brief Pagination system
 * @author MartonBash Development & debug (CS-BG.info)
 * @version 0.77d
 * @last update 12 Aug 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Pag {
	var $output 	= '';
	var $limit 		= array();

	public function __construct($per_page, $results) {
		$total_pages = ceil($results / $per_page);
		$current_page = (isset($_GET['p'])) ? $_GET['p'] : null;

		if($current_page == null) {
			$current_page = 1;
		} else {
			if($current_page <= 0) {
				$current_page = 1;
			}
			$current_page = ($current_page > $total_pages) ? $total_pages : $current_page;
		}



		$previous = $current_page - 1;
		$next = $current_page + 1;

		$this->limit['first'] 	= ($current_page * $per_page) - $per_page;
		$this->limit['second'] 	= $per_page;


			$GETItems = array();
			foreach($_GET as $name => $value) {
				if ($name != 'p') {
					$GETItems[] = $name.'='.$value;
				}
			}
			$GETItems = (!empty($GETItems)) ? implode('&', $GETItems).'&p' : 'p';


		$this->output .= '<div class=\'pagination\'>';

		if ($current_page != 1) {
			$this->output .= '<a href=\'?'.$GETItems.'='.$previous.'\' class=\'active\'>«</a>';
		} else {
			$this->output .= '<span class=\'inactive\'>«</span>';
		}

		if ($total_pages <= 7) {
			$loop_start = 1;
			$loop_range = $total_pages;
		} else {
			$loop_start = $current_page - 3;
			$loop_range = $current_page + 3;

			$loop_start = ($loop_start < 1) ? 1 : $loop_start;
			while ($loop_range - $loop_start < 6) { $loop_range++; }

			$loop_range = ($loop_range > $total_pages) ? $total_pages : $loop_range;
			while ($loop_range - $loop_start < 6) { $loop_start--; }
		}

		if ($loop_start != 1) {
			$this->output .= '<a href=\'?'.$GETItems.'=1\' class=\'active\'>1</a>...';
		}

		for ($p = $loop_start; $p <= $loop_range; $p++) {
			if ($p != $current_page) {
				$this->output .= '<a href=\'?'.$GETItems.'='.$p.'\' class=\'active\'>'.$p.'</a>';
			} else {
				$this->output .= '<span class=\'current\'>'.$p.'</span>';
			}
		}

		if ($loop_range != $total_pages) {
			$this->output .= '...<a href=\'?'.$GETItems.'='.$total_pages.'\' class=\'active\'>'.$total_pages.'</a>';
		}

		if ($current_page != $total_pages) {
			$this->output .= '<a href=\'?'.$GETItems.'='.$next.'\' class=\'active\'>»</a>';
		} else {
			$this->output .= '<span class=\'inactive\'>»</span>';
		}

		$this->output .= '</div>';
	}
}
