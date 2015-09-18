<?php

/**
 * @file index.php
 * @brief Start app point
 * @author MartonBash Development
 * @version 2.18d
 * @last update 13 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */

error_reporting(-1);
//$application->empty_dir('install');

require "configure.php";
$application = new MB_Bootstrap();

if(is_dir(MB_INSTALL_DIR)) {
    header("Location: install/step_1");
    exit;
}
