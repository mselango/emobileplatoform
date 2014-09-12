<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 11/27/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 */

/*
 * This file demonstrates how to create a User. It also creates a Zendesk user account
 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (type int)
 * 2. First Name (type string)
 * 3. Last Name (type string)
 * 4. Email (type string)
 * 5. Mobile no.(type int)
 * 6. Phone no. (type int)
 * 7. Username (type string) Only letters, numbers, and _ are allowed
 * 8. Password (type string) Must contain upper and lower case letters with number. Must be between 8-32 digits
 * 9. Permission_Group_Id (type int)
 * 
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
	 * @param type int account_id The Account_id under which a user has to be created
	 */
	$p->addParam('account_id', XXXX);
	
	/**
	 * @param type string first_name. The first name for the user account
	 */
	$p->addParam('first_name', 'John');

	/**
	 * @param type string last_name. The last name for the user account
	 */
	$p->addParam('last_name', 'Doe');

	/**
	 * @param type string email. The email address for the user
	 *  Must be a unique and valid e-mail address
	 */
	$p->addParam('email', 'john.doe38@example.com');

	/**
	 * @param type int mobile. The mobile phone number for the user
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('mobile', XXXXXXXXXX);

	/**
	 * @param type int phone. The phone number for the userL
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('phone', XXXXXXXXXX);

	/**
	 * @param type string website. The website for the user
	 *  Must be a valid domain name.
	 */
	$p->addParam('website', 'example.com');
	
	/**
	 * @param type string username. The username used to login to the user account
	 *  Must be a unique username. Only letters, numbers, and _ allowed.
	 */
	$p->addParam('username', 'rprincipe_test138');

	/**
	 * @param type string password. The password used with username to access the user account
	 *  Must contain upper and lower case letters with number. Must be between 8-32 digits.
	 */
	$p->addParam('password', 'rprincipeQWERTY202019');
	
	/**
	 * @param type int permission_group_id. The permission group of the user to be created for the current account
	 * permission_group_id : group_name 
	 *	1	:  Father
	 *	2	:  Admin	
	 *  4	:  Customer Support
	 */
	$p->addParam('permission_group_id', 1);

	/**
	 * @todo Remove any parameters below that you are not using 
	 *
	 * All parameters below are optional
	 * If you do not want to pass any of these parameters to the API simply remove those addParam statements
	 */

	/**
	 * @param type string website. The website for the user
	 *  Must be a valid domain name.
	 */
	$p->addParam('website', 'example.com');

	$r = $e->executeAction('user', 'create', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo 'User Created Susccessfully';

		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
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