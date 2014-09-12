<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 12/13/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 */

/*
 * This file demonstrates how to send a one-off text message via the API.
 * The phone number supplied is not stored in a database. This only sends
 * a single message that is 160 characters or less. You must include opt-out
 * information.
 */

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'AABCPOC');

define('EMOBILE_API_KEY', 'jM5iE2rCuEhNYDPp5K5D1eJbw');

$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

$p = new eMobile\Param();
try
{
	/**
	 * @param type int account_id. The account_id using which the message has to be sent
	 * 
	 * Account has to be of client type
	 */ 
	$p->addParam('account_id', 37297);

	/**
	 * @param type int mobile
	 * 
	 * A ten digit mobile number.
	 */ 
	$p->addParam('mobile', 5624004910);

	/**
	 * @param type string shortcode
	 * 
	 * A valid shortcode on your account.
	 */ 	
	$p->addParam('shortcode', '63975');

	/**
	 * @param type string shortcode
	 * 
	 * Message string. Must be 160 characters.
	 */ 	
	$p->addParam('message', 'this is test message from POC');

	$r = $e->executeAction('message', 'send', $p);
print_r($r);
	if ($r->isSuccessful())
	{
		$data = $r->getData();
		echo "<br>";
		echo 'Message Sent';

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
