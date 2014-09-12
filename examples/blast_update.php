<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 12/06/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to update a SMS BLAST Campaign via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (Account must be of a client type) (type int)
 * 2. SMS Blast campaign name (type string)
 * 3. SMS Blast message (type string)
 * 4. Campaign Start time (type date string Y-m-d H:i:s)
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
	 * @param type int account_id. The Account to which the blast campaign is associated with
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXX);

	/**
	 * @param type int blast_id. Id of SMS Blast Campaign to be updated
	 * 
	 */ 
	$p->addParam('blast_id', XXX);

	/**
	 * @param type string campaign. Name of the SMS Blast Campaign
	 */ 
	$p->addParam('campaign', 'SMS BLAST TEST53');

	/**
	 * @param type string meesage. The message to be sent
	 */
	$p->addParam('message', 'THIS IS A TEST SMS BLAST');
 
	/**
	 * @param type date/string SMS BLAST Campaign Schedule Time
	 * Format: YYYY-MM-DD TIMEZONE hh:mm:ss
	 * Ex: 2013-12-09 EST 10:25:00
	 */ 
	$p->addParam('schedule', 'XXX');

	/**
	 * @param type int group_id. Group to send the SMS Blast to
	 */ 
	$p->addParam('group_id', XXX);
	
	$r = $e->executeAction('message', 'blast_update', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Blast Updated Successfully' ;

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
