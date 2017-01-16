<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 13/1/17
 * Time: 3:14 PM
 */
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
To reset your password, complete this form: {{ URL::to('password/reset', array($token)) }}.<br/>
This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
</div>
</body>
</html>