<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 11/05/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to check if a keyword is available for a given shortcode via the API.
 * 
 * This functionality requires the following parameters. These are not optional.
 * 
 * Keyword (type string)
 * 
 */

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'ENTER_USERNAME_HERE');

define('EMOBILE_API_KEY', 'ENTER_USERNAME_HERE');

$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

$p = new eMobile\Param();
try
{
	/**
	 *  @param type string keyword. The keyword to check availability
	 */
	$p->addParam('keyword', 'create5');
	
		
	/**
	 * @todo Remove any parameters below that you are not using 
	 *
	 * All parameters below are optional
	 * If you do not want to pass any of these parameters to the API simply remove those addParam statements
	 */
		
	/**
	 *  @param type int account_id. The Account_id to be used to check for the keyword availability
	 *   Usually the account_id where this keyword will be used
	 */
	$p->addParam('account_id', XXXX);

	$r = $e->executeAction('message', 'keyword_isavailable', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo 'Keyword is available: ';
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	else
	{
		echo $r->getMessage();
	}
}
catch (\Exception $a)
{
	error_log($a->getMessage());
	echo 'Exception: ' . $a->getMessage();
}
?>
