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
 * This file demonstrates how to update information of a User
 * This will not change the password of the user account

 * This functionality requires the following parameters. 
 * ## These are not optional ##
 * 
 * 1. Account_id (type int)
 * 2. User_id (type int)
 * 3. First Name (type string)
 * 4. Last Name (type string)
 * 5. Email (type string)
 * 6. Mobile no.(type int)
 * 7. Phone no. (type int)
 * 8. Username (type string) Only letters, numbers, and _ are allowed
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
	 * @param type int account_id. The Account_id to which the user belongs to
	 */
	$p->addParam('account_id', XXXX);
	
	/**
	 * @param type int user_id The user_id of the user to be updated
	 */
	$p->addParam('user_id', XXXX);
		
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
	$p->addParam('email', 'john.doe34@example.com');

	/**
	 * @param type int mobile. The mobile phone number for the user
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('mobile', XXXXXXXXXX);

	/**
	 * @param type int phone. The phone number for the user
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('phone', XXXXXXXXXXX);
	
	/**
	 * @param type string username. The username used to login to the user account
	 *  Must be a unique username. Only letters, numbers, and _ allowed.
	 */
	$p->addParam('username', 'rprincipe_test34');
		
	
	/**
	 * @todo Remove any parameters below that you are not using 
	 *
	 * All parameters below are optional
	 * If you do not want to pass any of these parameters to the API simply remove those addParam statements
	 */
	
	/**
	 * @param type int permission_group_id. The permission group of the user to be created for the current account
	 * permission_group_id : group_name 
	 *	1	:  Father
	 *	2	:  Admin	
	 *  4	:  Customer Support
	 */
	$p->addParam('permission_group_id', 1);

	/**
	 * @param type int user_status. The status of the user account
	 * user_status_id : user_status
	 *	1: Active
	 *  2: Suspended
	 *  3: Deleted
	 */
	$p->addParam('user_status', 1);

	/**
	 * @param type string website. The website for the user
	 *  Must be a valid domain name.
	 */
	$p->addParam('website', 'example.com');

	$r = $e->executeAction('user', 'update', $p);

	if ($r->isSuccessful())
	{
		echo '<br>';
		echo 'User Updated Susccessfully';
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