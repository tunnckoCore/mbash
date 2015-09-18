<?php
/**
 * @file configure.php
 * @brief Instaltion Configures Settings
 * @last update 13 Oct 2012
 * @copyright (C) 2012 MartonBash Development
 * @license Common Development and Distribution License -
 * @package MartonBash CMS
 */
error_reporting(-1);
#
 define('MB_CMS', true);
 define('MB_ROOT',dirname(__FILE__).'/');
# -----------------------------------------------------------------------------+
# INCLUDES
 require(MB_ROOT.'libs/iMartonBashControllers.php');
 require(MB_ROOT.'libs/aBaseController.php');
 require(MB_ROOT.'libs/aBaseView.php');
 require(MB_ROOT.'controllers/baseController.php');
 require(MB_ROOT.'controllers/baseView.php');
 require(MB_ROOT.'libs/Bootstrap.php');
 require(MB_ROOT.'libs/Libs.php');
 require(MB_ROOT.'libs/tds4.php');
 require(MB_ROOT.'libs/Pagination.php');
# -----------------------------------------------------------------------------+
# SET MAIN ENCODING
 header('Content-Type: text/html; charset=UTF-8');
# -----------------------------------------------------------------------------+
