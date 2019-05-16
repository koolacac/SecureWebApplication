<!DOCTYPE html>
<html lang="en">
<?php include 'controllers/authController.php' ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <title>User verification system PHP - Login</title>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth login login-form">
        <h2 class="text-center form-title">Log in</h2>
        <form action="login.php" method="post">
          <div class="form-group">
            <input type="text" name="username"  class="form-control" placeholder="Username" required="required" value="">
          </div>
          <div class="form-group">
            <input type="password"  name="password"  class="form-control" placeholder="Password" required="required">
          </div>
          <div class="form-group">
            <button type="submit" name="login-btn" class="btn btn-primary btn-block">Log in</button>
          </div>
		  <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                <a href="resetpwd.php" class="pull-right">Forgot Password?</a>
            </div>
        </form>
        <p>Don't yet have an account? <a href="signup.php">Create an Account</a></p>
      </div>
    </div>
  </div>
</body>
</html>