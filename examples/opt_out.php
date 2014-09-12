<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 12/12/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to Opt Out a Member from the Marketing Center DB via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (Account must be of a client type) (type int)
 * 2. Phone numbers (type array)
 * 
 */

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'blamo54');

define('EMOBILE_API_KEY', 'dt5yp0vspgdfpi8905lkns');

$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

$p = new eMobile\Param();
try
{
	/**
	 * @param type int account_id. The Account_id to which the member belongs
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXXX);

	
	/**
	 * @param type int ph_number. The phone number of the member who wants to OPT OUT.
	 */
	$p->addParam('ph_number', XXXXXX);

	$r = $e->executeAction('message', 'opt_out', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Member Opted Out Successfully' ;

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
