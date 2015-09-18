<?php
/**
 * @file Database.php
 * @brief MartonBash DBAL Small and connection point
 * @author MartonBash Development
 * @version 0.1d
 * @last update 14 Aug 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
if(defined('CERR_HANDLER')) error_reporting(-1);

class Database {

    public function __construct($dbHost, $dbUser, $dbPass, $dbName) {
        $this->dbConnect($dbHost, $dbUser, $dbPass, $dbName);
    }

    public function dbConnect($dbHost, $dbUser, $dbPass, $dbName) {
        mysql_connect($dbHost, $dbUser, $dbPass) or die("Error connecting to database: " . mysql_error());
        mysql_select_db($dbName) or die("Error selecting database: " . mysql_error());
        $this->runQuery("SET NAMES UTF8");
    }

    public function runQuery($sql) {
        $rs = mysql_query($sql);
        if (mysql_error()) {
			if(defined('SHOW_SQL_ERRORS')) {
				echo '<b>Desc: </b>' . mysql_error() . '<br/><b>SQL:</b> ' . $sql.'<hr/>';
			} else {
				header('Location: 404');
			}            
        }
        return $rs;
    }
    
    public function delQuery($table, $where) {
        $this->runQuery('DELETE FROM ' . $table . ' WHERE ' . $where);
    }

    

}
