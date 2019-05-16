# SecureWebApplication
Secure Web Application

Step 1: Install xampp from https://www.apachefriends.org/download.html and paste the above zip code from github in htdocs directory.</br>

Step 2: Set Up the database using phpmyadmin by issuing the following command.</br>

=> Create a database called verify-user and in this database</br>
``CREATE DATABASE verify-user`` </br>

=> Create a users table with attributes as follows: </li></br>
``CREATE TABLE `users` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL, 
 `verified` tinyint(1) NOT NULL DEFAULT '0', 
 `token` varchar(255) DEFAULT NULL, 
 `password` varchar(255) NOT NULL, 
 PRIMARY KEY (`id`) 
) ``

Step 3: Start the Apache and Mysql service, Navigate to the http://localhost/zendesk/login.php </br>

Following Functionalities are implemented:</br>

1) Register new user on create an account page: http://localhost/zendesk/signup.php : 
<li>Username must be more than 5 characters and should contain only letter and digit, </li>
<li>Email should be valid,</li>
<li>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit,</li>
<li>Username and email should be new,</li>
<li>Password and confirm password should be same,</li>
<li>All fields are required,</li>
<li>Input validation to allow only required characters,</li>
<li>Hashing the password,</li>
<li>Email verification (In Progress)</li>

2) Login Page: </br>
<li>Input validation,</li>
<li>SQL Injection prevention using bind parameterized query,</li>
<li>Hashing the password,</li>
<li>Setting session cookie with httponly, expiry, secure (if https),</li>
<li>Recaptcha / MFA (In Progress),</li>
<li>Logging (In Progress),</li>

3) Post Login Page: </br>
<li>Change password page (In Progress),</li>
<li>Logout. </li>

4)  Logout Page:</br> 
<li>Destroy Session,</li>
<li>Unset all session cookies,</li>

5) Change Password Page  (In Progress)</br>
<li>All fields required,</li>
<li>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit,</li>
<li>Generate CSRF token,</li>
<li>Validate old password,</li>
<li>Sanitise current password input,</li>
<li>Check that the current password is correct,</li>
<li>Do both new passwords match and does the current password match the user?</li>
<li>Update database with new password.</li>
