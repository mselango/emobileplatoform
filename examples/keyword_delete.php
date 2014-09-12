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
 * This file demonstrates how to delete a keyword using the keyword_id via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Keyword_id (type int)
 * 2. Account_id (type int) (Account must be of a client type)
 * 3. Shortcode (type int)
 */

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'ENTER_USERNAME_HERE');

define('EMOBILE_API_KEY', 'ENTER_API_KEY_HERE');

$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

$p = new eMobile\Param();
try
{
	/**
	 * @param type int account_id. The account_id using which the keyword campaign was created
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXXX);

	/**
	 * @param type int Keyword_id of the keyword to be updated
	 */ 
	$p->addParam('keyword_id', XXXX);

	/**
	 * @param type int shortcode for Keyword campaign
	 */
	$p->addParam('shortcode', 63975);

	$r = $e->executeAction('message', 'keyword_delete', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo 'Keyword Deleted Successfully';
		
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
