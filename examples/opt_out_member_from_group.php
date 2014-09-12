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
 * This file demonstrates how to Opt Out a Member from a specific group in the Marketing Center DB via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (Account must be of a client type) (type int)
 * 2. Group_id (Group from which the members have to be removed)
 * 3. Phone numbers (type array)
 * 
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
	 * @param type int account_id. The account_id under which the group is created
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXXX);

	/**
	 * @param type int group_id. Group to which the members belong to
	 *  Use group_list.php to check the available/existing groups
	 */ 
	$p->addParam('group_id', XXXX);
	
	/**
	 * @param type array ph_numbers. The phone numbers() of members who want to OPT OUT.
	 *  Can contain a single phone number, or an array of phone numbers.
	 */
	$p->addParam('ph_numbers', array(XXXX, XXXX, XXXX));

	$r = $e->executeAction('message', 'opt_out_members_from_group', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Members Opted Out Successfully' ;

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
