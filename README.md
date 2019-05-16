# SecureWebApplication
Secure Web Application

Step 1: Install xampp from https://www.apachefriends.org/download.html and paste the above zip code from github in htdocs directory.

Step 2: Set Up the database using phpmyadmin by issuing the following command.

=> Create a database called verify-user and in this database</br>
CREATE DATABASE verify-user</br>

=> Create a users table with attributes as follows: </br>
CREATE TABLE `users` ( </br>
 `id` int(11) NOT NULL AUTO_INCREMENT, </br>
 `username` varchar(100) NOT NULL, </br>
 `email` varchar(100) NOT NULL, </br>
 `verified` tinyint(1) NOT NULL DEFAULT '0', </br>
 `token` varchar(255) DEFAULT NULL, </br>
 `password` varchar(255) NOT NULL, </br>
 PRIMARY KEY (`id`) </br>
) </br>

Step 3: Start the Apache and Mysql service, Navigate to the http://localhost/zendesk/login.php </br>

Following Functionalities are implemented:</br>

1) Register new user on create an account page: http://localhost/zendesk/signup.php : </br>
Username must be more than 5 characters and should contain only letter and digit, </br>
Email should be valid,</br>
Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit,</br>
Username and email should be new,</br>
Password and confirm password should be same,</br>
All fields are required,</br>
Input validation to allow only required characters,</br>
Hashing the password,</br>
Email verification (In Progress)</br>

2) Login Page: </br>
Input validation,</br>
SQL Injection prevention using bind parameterized query,</br>
Hashing the password,</br>
Setting session cookie with httponly, expiry, secure (if https),</br>
Recaptcha / MFA (In Progress),</br>
Logging (In Progress),</br>

3) Post Login Page: </br>
Change password page (In Progress),</br>
Logout. </br>

4)  Logout Page:</br> 
Destroy Session,</br>
Unset all session cookies,</br>

5) Change Password Page  (In Progress)</br>
All fields required,</br>
Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit,</br>
Generate CSRF token,</br>
Validate old password,</br>
Sanitise current password input,</br>
Check that the current password is correct,</br>
Do both new passwords match and does the current password match the user?</br>
Update database with new password.</br>
