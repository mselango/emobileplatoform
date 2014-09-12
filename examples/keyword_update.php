<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 11/05/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 * 
 * This file demonstrates how to update a keyword using the keyword_id via the API.
 * 
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Keyword_id (type int)
 * 2. Account_id (Account must be of a client type) (type int)
 * 3. Shortcode (type int)
 * 4. Keyword campaign name (type string)
 * 5. Reply message (type string)
 * 
 * The optional parameters are:
 * 
 * 1. Campaign Start time (type date string Y-m-d H:i:s)
 * 2. Campaign Start timezone (type string)  
 * 		Ex: Central Timezone can be represented by 'C'
 * 3. Campaign End time (type date string Y-m-d H:i:s) 
 * 4. Campaign End timezone (type string)
 * 5. Callbackurl (type string)
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
	*  @param type int account_id. The account_id the keyword campaign belongs to
	*  Account has to be of client type
	*/
	$p->addParam('account_id', XXXX);

	/**
	 *  @param type string Keyword campaign name
	 */
	$p->addParam('name', 'KEYWORD CREATE TEST 12333');

	/**
	 *  @param type int Keyword_id of the keyword to be updated
	 */
	$p->addParam('keyword_id', XXXX);

	/**
	 *  @param type string Reply message
	 */
	$p->addParam('reply', 'TESTaa1122');

	/**
	 *  @param type int shortcode for Keyword campaign
	 */
	$p->addParam('shortcode', 63975);

		
	/**
	 * @todo Remove any parameters below that you are not using 
	 *
	 * All parameters below are optional
	 * If you do not want to pass any of these parameters to the API simply remove those addParam statements
	 */
	
	 /**
	  *  @param type date string Keyword campaign start time
	  */
	$p->addParam('start', '2013-11-5 10:00:00');

	/**
	 *  @param type string Keyword campaign start timezone 
	 *  Expected values: P, M, C or E
	 */
	$p->addParam('start_timezone', 'C');

	/**
	 * @param type string Keyword campaign end time
	 */
	$p->addParam('end', '2015-07-01 23:09:59');

	/**
	 * @param type string Keyword campaign end timezone 
	 *  Expected values: P, M, C or E
	 */
	$p->addParam('end_timezone', 'C');

	/**
	 * @param type string callbackurl
	 */
	$p->addParam('callbackurl', 'example.com');

	$r = $e->executeAction('message', 'keyword_update', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo 'Keyword Updated Successfully ';

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
