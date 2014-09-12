<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 11/18/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to get the total clients via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (type int)
 * 2. Start Date (type Date, Format: Y-M-D)
 * 3. End Date (type Date, Format: Y-M-D)
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
	 *  @param type int account_id. The Account_id for which the no. of clients is requested
	 */
	$p->addParam('account_id', XXXX);

	/**
	 *  @param type string/date format start_date Y-M-D.
	 */
	$p->addParam('start_date', "2013-06-01");

	/**
	 *  @param type string/date format end_date Y-M-D.
	 */
	$p->addParam('end_date', "2013-09-01");

	$r = $e->executeAction('billing', 'get_total_clients', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo "Total no. of clients";
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
