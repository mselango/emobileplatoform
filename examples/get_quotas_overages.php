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
 * This file demonstrates how to get the quota overages via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (type int)
 * 2. Month (type int, Format: MM)
 * 3. Year (type int, Format: YYYY)
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
	 *  @param type int account_id. The Account_id to check charges for
	 */
	$p->addParam('account_id', XXX);

	/**
	 * @param type int MM. The month for which the quota overages should be calculated
	 */
	$p->addParam('month', '06');

	/**
	 * @param type int YYYY. The year for which the quota overages should be calculated
	 */
	$p->addParam('year', '2013');


	$r = $e->executeAction('billing', 'get_quotas_overages', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo 'Overages: ';
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
