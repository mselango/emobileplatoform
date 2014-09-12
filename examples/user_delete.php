<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 12/02/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 */

/*
 * This file demonstrates how to delete a User
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (type int)
 * 2. User_id (type int)
*/

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'ENTER_USERNAME_HERE');

define('EMOBILE_API_KEY', 'ENTER_API_KEY_HERE');

try
{
	$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

	$p = new eMobile\Param();

	/**
	 * @param type int account_id. The account the user to be deleted belongs to
	 */
	$p->addParam('account_id', XXXX);
	
	/**
	 * @param type int user_id The id of the user to be deleted
	 */
	$p->addParam('user_id', XXXX);
	
	$r = $e->executeAction('user', 'delete', $p);

	if ($r->isSuccessful())
		echo 'User Deleted Susccessfully';
	else
		echo $r->getMessage();
}
catch (\Exception $a)
{
	error_log($a->getMessage());
	echo 'Exception: ' . $a->getMessage();
}
?>