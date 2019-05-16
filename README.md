# SecureWebApplication
Secure Web Application

Step 1: Install xampp from https://www.apachefriends.org/download.html and paste the above zip code from github in htdocs directory.

Step 2: Set Up the database using phpmyadmin by issuing the following command.

=> Create a database called verify-user and in this database,
CREATE DATABASE verify-user

=> Create a users table with attributes as follows: 
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `verified` tinyint(1) NOT NULL DEFAULT '0',
 `token` varchar(255) DEFAULT NULL,
 `password` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
)

Step 3: Start the Apache and Mysql service, Navigate to the http://localhost/zendesk/login.php

Following Functionalities are implemented:

1) Register new user on create an account page: http://localhost/zendesk/signup.php 
Username must be more than 5 characters and should contain only letter and digit
Email should be valid
Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit.
Username and email should be new.
Password and confirm password should be same.
All fields are required
Input validation to allow only required characters.
Hashing the password.
Email verification (In Progress)

2) Login Page
Input validation
SQL Injection prevention using bind parameterized query
Hashing the password
Setting session cookie with httponly, expiry, secure (if https)
Recaptcha / MFA (In Progress)
Logging (In Progress)

3) Post Login Page
Change password page (In Progress)
Logout 

4)  Logout Page
Destroy Session
Unset all session cookies.

5) Change Password Page  (In Progress)
All fields required
Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit.
Generate CSRF token
Validate old password
Sanitise current password input
Check that the current password is correct
Do both new passwords match and does the current password match the user?
Update database with new password
