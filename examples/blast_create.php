<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 11/04/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to create a SMS BLAST through the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (Account must be of a client type) (type int)
 * 2. SMS Blast campaign name (type string)
 * 3. SMS Blast message (type string)
 * 4. Campaign Schedule
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
	 * @param type int account_id. The Account to which the blast campaign should be associated with
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXXX);

	/**
	 * @param type string campaign. Name of the SMS Blast Campaign
	 */ 
	$p->addParam('campaign', 'SMS BLAST TEST3');

	/**
	 * @param type string meesage. The message to be sent
	 */
	$p->addParam('message', 'THIS IS A TEST SMS BLAST');
 
	/**
	 * @param type date/string SMS BLAST Campaign Schedule Time
	 * Format: YYYY-MM-DD TIMEZONE hh:mm:ss
	 */ 
	$p->addParam('schedule', '2013-12-09 EST 10:10:00');

	/**
	 * @param type int group_id. Group to send the SMS Blast to
	 *  Use group_list.php to check the available/existing groups
	 */ 
	$p->addParam('group_id', XX);
	
	$r = $e->executeAction('message', 'blast_create', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Blast Created Successfully' ;

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
