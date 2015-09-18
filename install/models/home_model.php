<?php
/**
 * @file home_model.php
 * @brief Get data from SQL
 * @author MartonBash Development
 * @version 1.02d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Home_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function selectData($INDB, $selected, $all = false) {
		if($all === false) {
			return $this->db->runQuery('SELECT * FROM ' . MB_NEWS . ' WHERE '. $INDB .' = "' . $selected . '"');
		} else {
			return $this->db->runQuery('SELECT '. $all .' FROM ' . MB_NEWS . ' WHERE '. $INDB .' = "' . $selected . '"');
		}
	}
	
    public function delete($TABLE, $INDB, $ID) {
        return $this->db->runQuery('DELETE FROM ' . $TABLE . ' WHERE '. $INDB .' = ' . $ID);
    }

    public function addArticle($newsName, $newsTitle, $newsText, $newsTags, $newsAuthor, $newsDate, $newsSEOurl) {
        return $this->db->runQuery("INSERT INTO " . MB_NEWS . " (newsName, newsTitle, newsText, newsTags, newsAuthor, newsDate, newsSEOurl)
		VALUES ('$newsName', '$newsTitle', '$newsText', '$newsTags', '$newsAuthor', '$newsDate', '$newsSEOurl')");
		
    }

    public function editArticle($newsName, $newsText, $newsTitle, $newsTags, $newsSEOurl, $updateDate, $id) {
        return $this->db->runQuery("UPDATE " . MB_NEWS . " SET newsName = '$newsName', newsText = '$newsText', newsTitle = '$newsTitle', newsTags = '$newsTags', newsSEOurl = '$newsSEOurl', newsDate = '$updateDate' WHERE newsID = '$id'");
    }

	public function cntNews() {
		return $this->db->runQuery('SELECT COUNT(`newsID`) AS allRows FROM ' . MB_NEWS);
	}
	
	public function getPages($startpoint, $max) {
		 return $this->db->runQuery("SELECT * FROM " . MB_NEWS . " ORDER BY newsID DESC LIMIT {$startpoint},{$max}");
	}
}