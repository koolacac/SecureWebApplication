<?php
session_start();
$username = "";
$email = "";
$errors = [];

header('X-Frame-Options: SAMEORIGIN');
header('Cache-Control: no-cache, no-store, must-revalidate');
$name = 'zendesk';
$value= isset($_SESSION['id']);
$expire = time() + 60*60*24*7;
$path = '/';
$domain = 'localhost';
$secure = isset($_SERVER['HTTPS']);
$httponly = true;

setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);

$conn = new mysqli('localhost', 'root', '', 'verify-user');

// SIGN UP USER
if (isset($_POST['signup-btn'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username required';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
	
			// Validate Username
	if (preg_match("/^[0-9a-zA-Z_]{5,}$/", $_POST["username"]) === 0) {
        $errors['username'] = 'Username must be more than 5 characters and should contain only letter and digit';
    }
	
			// validate email
	if (preg_match("/^\S+@\S+\.\S+$/", $_POST["email"]) === 0) {
        $errors['email'] = 'Please enter valid email';
    }
	
		// Password must be strong
	if (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0) {
        $errors['password'] = 'Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
    }

    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'The two passwords do not match';
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

 // Check if username already exists
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['username'] = "username already exists";
    }
	
    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Email already exists";
    }


    if (count($errors) === 0) {
        $query = "INSERT INTO users SET username=?, email=?, token=?, password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $username, $email, $token, $password);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            // sendVerificationEmail($email, $token);

            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location: index.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}

// Change Password Page
if (isset($_POST['change-btn'])) {
    if (empty($_POST['oldpass'])) {
        $errors['oldpass'] = 'Old Password required';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'New Password required';
    }
	if (empty($_POST['passwordConf'])) {
        $errors['passwordConf'] = 'Confirm Password required';
    }
	
		// Password must be strong
	if (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0) {
        $errors['password'] = 'Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit';
    }

    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'The two passwords do not match';
    }
	
	$oldpass = $_POST['oldpass'];
	$password = $_POST['password'];
	$passwordConf = $_POST['passwordConf'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $oldpass = password_hash($_POST['oldpass'], PASSWORD_DEFAULT); //encrypt password
	
    $username =   $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username='$username' AND password ='$oldpass' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['oldpass'] = "Old password match";
    }

}

// LOGIN
if (isset($_POST['login-btn'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: index.php');
                exit(0);
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}