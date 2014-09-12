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
 * This file demonstrates how to delete a SMS BLAST campaign via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (Account must be of a client type) (type int)
 * 2. SMS Blast Id (type int)
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
	 * @param type int account_id. The Account to which the blast campaign belongs
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', XXXX);

	/**
	 * @param type int blast_id. Id of the SMS blast campaign to be deleted
	 */ 
	$p->addParam('blast_id', XXXX);

	$r = $e->executeAction('message', 'blast_delete', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Blast Deleted Successfully' ;

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
