<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 06/27/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 */

/*
 * This file demonstrates how to delete an account through the API
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 *  Account_id (type int)
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
	 * @param type int account_id The id of the account to be deleted
	 */
	$p->addParam('account_id', XXXX);

	$r = $e->executeAction('account', 'delete', $p);

	if ($r->isSuccessful())
	{
		echo 'Account Deleted Successfully';
	}
	else
	{
		echo $r->getMessage();
	}

}
catch (\Exception $a)
{
	error_log($a->getMessage());
	echo 'Exception: '.$a->getMessage();
}
?>