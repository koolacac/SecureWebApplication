# SecureWebApplication
Secure Web Application

Step 1: Install xampp from https://www.apachefriends.org/download.html and paste the above zip code from github in htdocs directory.

Step 2: Set Up the database using phpmyadmin by issuing the following command.

=> Create a database called verify-user and in this database</br>
``CREATE DATABASE verify-user`` </br>

=> Create a users table with attributes as follows: </li></br>
``CREATE TABLE `users` ( </li></br>
 `id` int(11) NOT NULL AUTO_INCREMENT, </li></br>
 `username` varchar(100) NOT NULL, </li></br>
 `email` varchar(100) NOT NULL, </li></br>
 `verified` tinyint(1) NOT NULL DEFAULT '0', </li></br>
 `token` varchar(255) DEFAULT NULL, </li></br>
 `password` varchar(255) NOT NULL, </li></br>
 PRIMARY KEY (`id`) </li></br>
) </li></br>``

Step 3: Start the Apache and Mysql service, Navigate to the http://localhost/zendesk/login.php </br>

Following Functionalities are implemented:</br>

1) Register new user on create an account page: http://localhost/zendesk/signup.php : 
<li>Username must be more than 5 characters and should contain only letter and digit, </li>
<li>Email should be valid,</li>
<li>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit,</li>
<li>Username and email should be new,</li></br>
<li>Password and confirm password should be same,</li></br>
<li>All fields are required,</li></br>
<li>Input validation to allow only required characters,</li></br>
<li>Hashing the password,</li></br>
<li>Email verification (In Progress)</li></br>

2) Login Page: </li></br>
Input validation,</li></br>
SQL Injection prevention using bind parameterized query,</li></br>
Hashing the password,</li></br>
Setting session cookie with httponly, expiry, secure (if https),</li></br>
Recaptcha / MFA (In Progress),</li></br>
Logging (In Progress),</li></br>

3) Post Login Page: </li></br>
Change password page (In Progress),</li></br>
Logout. </li></br>

4)  Logout Page:</li></br> 
Destroy Session,</li></br>
Unset all session cookies,</li></br>

5) Change Password Page  (In Progress)</li></br>
All fields required,</li></br>
Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit,</li></br>
Generate CSRF token,</li></br>
Validate old password,</li></br>
Sanitise current password input,</li></br>
Check that the current password is correct,</li></br>
Do both new passwords match and does the current password match the user?</li></br>
Update database with new password.</li></br>
