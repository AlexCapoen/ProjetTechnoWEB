<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styleLoginRegister.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
  <title>Login</title>
</head>
<body>
 	<div id='loginContainer'>
  		<div id="formLogin">
		  	<form action="" class="container">
		    <h1>Login</h1>

		    <label  for="email"><b class="itemLogin">Email</b></label>
		    </br>
		    <input type="text" placeholder="Enter Email" name="email" required>
		    </br>
		    <label class="itemLogin" for="psw"><b class="itemLogin">Password</b></label>
		    </br>
		    <input type="password" placeholder="Enter Password" name="psw" required>
			</br>
		    <button class="button" type="submit">Login</button>
		    <a id="registerLink" href="register.php">register</a>
	    </div>
  </div>
</body>
</html>