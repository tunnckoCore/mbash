<?php
/**
 * @file Libs.php
 * @brief MartonBash functions library
 * @author MartonBash Development
 * @version 0.2d
 * @last update 12 Oct 2012
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */

if(defined('CERR_HANDLER')) error_reporting(-1);

function tdsEsc($foo) {
		$foo = isset($foo) ? $foo : $foo;
		$foo = is_int($foo) ? (int) $foo : $foo;
		$foo = get_magic_quotes_gpc() ? stripslashes($foo) : $foo;
		$foo = mysql_real_escape_string($foo);
		$foo = htmlspecialchars($foo);
		$foo = trim($foo);
		   
    return $foo;
}

function validEmail($var) {
	return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function sqlFetchRow($query_id = false) {
    return ($query_id !== false) ? @mysql_fetch_assoc($query_id) : false;
}


/* bbcode parser */
function bbcodeParser($bbcode){

	/*
	Commands include
	* bold
	* italics
	* underline
	* typewriter text
	* strikethough
	* images
	* urls
	* quotations
	* code (pre)
	* colour
	* size
	*/

		/* Matching codes */
		$urlmatch = "([a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+)";

		/* Basically remove HTML tag's functionality */
		$bbcode = htmlspecialchars($bbcode);

		/* Replace "special character" with it's unicode equivilant */
		$match["special"] = "/\?/s";
		$replace["special"] = '&#65533;';

		/* Bold text */
		$match["b"] = "/\[b\](.*?)\[\/b\]/is";
		$replace["b"] = "<strong>$1</strong>";

		/* Italics */
		$match["i"] = "/\[i\](.*?)\[\/i\]/is";
		$replace["i"] = "<i>$1</i>";

		/* Underline */
		$match["u"] = "/\[u\](.*?)\[\/u\]/is";
		$replace["u"] = "<span style=\"text-decoration: underline\">$1</span>";

		/* Typewriter text */
		$match["tt"] = "/\[tt\](.*?)\[\/tt\]/is";
		$replace["tt"] = "<span style=\"font-family:monospace;\">$1</span>";

		$match["ttext"] = "/\[ttext\](.*?)\[\/ttext\]/is";
		$replace["ttext"] = "<span style=\"font-family:monospace;\">$1</span>";

		/* Strikethrough text */
		$match["s"] = "/\[s\](.*?)\[\/s\]/is";
		$replace["s"] = "<span style=\"text-decoration: line-through;\">$1</span>";

		/* Color (or Colour) */
		$match["color"] = "/\[color=([a-zA-Z]+|#[a-fA-F0-9]{3}[a-fA-F0-9]{0,3})\](.*?)\[\/color\]/is";
		$replace["color"] = "<span style=\"color: $1\">$2</span>";

		$match["colour"] = "/\[colour=([a-zA-Z]+|#[a-fA-F0-9]{3}[a-fA-F0-9]{0,3})\](.*?)\[\/colour\]/is";
		$replace["colour"] = $replace["color"];

		/* Size */
		$match["size"] = "/\[size=([0-9]+(%|px|em)?)\](.*?)\[\/size\]/is";
		$replace["size"] = "<span style=\"font-size: $1;\">$3</span>";

		/* Images */
		$match["img"] = "/\[img\]".$urlmatch."\[\/img\]/is";
		$replace["img"] = "<img src=\"$1\" />";

		/* Links */
		$match["url"] = "/\[url=".$urlmatch."\](.*?)\[\/url\]/is";
		$replace["url"] = "<a href=\"$1\" target='_blank'>$2</a>";

		$match["surl"] = "/\[url\]".$urlmatch."\[\/url\]/is";
		$replace["surl"] = "<a href=\"$1\" target='_blank'>$1</a>";

		/* Quotes */
		$match["quote"] = "/\[quote\](.*?)\[\/quote\]/ism";
		$replace["quote"] = "<div class=\"bbcode-quote\">?$1?</div>";

		$match["quote"] = "/\[quote=(.*?)\](.*?)\[\/quote\]/ism";
		$replace["quote"] = "<div class=\"bbcode-quote\"><span class=\"bbcode-quote-user\" style=\"font-weight:bold;\">$1 said:</span><br />?$2?</div>";

		/* Parse */
		$bbcode = preg_replace($match, $replace, $bbcode);


		/* Remove <br> tags before quotes and code blocks */
		$bbcode=str_replace("?<br />","",$bbcode);
		$bbcode=str_replace("?","",$bbcode); //Clean up any special characters that got misplaced...

		/* Return parsed contents */
		return $bbcode;
}

function wrap($maxChars, $text, $link) {
	$text = substr($text,0,$maxChars);  
	$text = substr($text,0,strrpos($text,' '));  
	$text = $text."<span class='boldtext it'> ... <a href='$link' class='none'>прочети цялата статия</a></span>";  
	return $text;  
} 
	
?>