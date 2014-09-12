<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 12/10/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to delete a member via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (Account must be of a client type) (type int)
 * 2. Phone number (type int)
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
	 * @param type int account_id. The account under which the member was created
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXXX);

	/**
	 * @param type int phone number. The phone number of the member to be deleted
	 *  Should be a 10 digit number Ex: 1234567890
	 */ 
	$p->addParam('phone', XXXXXXXX);

	$r = $e->executeAction('message', 'member_delete', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Member Deleted Successfully' ;

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
