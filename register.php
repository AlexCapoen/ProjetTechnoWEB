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
        <form action="checkRegister.php" method='POST' class="container">
          <h1>Register</h1>

          <label  for="email"><b class="itemLogin">Enter your Name</b></label>
          </br>
          <input class="inputForm" type="text" placeholder="Name" name="Name" required>
          </br><label  for="email"><b class="itemLogin">Enter your First Name</b></label>
          </br>
          <input class="inputForm" type="text" placeholder="FirstName" name="FirstName" required>
          </br>

          <label  for="email"><b class="itemLogin">Enter your Email</b></label>
          </br>
          <input type="text" placeholder="Enter Email" name="email" required>
          </br>

          <label  for="email"><b class="itemLogin">Enter your phone</b></label>
          </br>
          <input type="text" placeholder="Enter phone" name="phone" required>
          </br>

          <label  for="email"><b class="itemLogin">Enter your birthdate</b></label>
          </br>
          <input type="datetime-local" placeholder="Enter birthdate" name="birthdate" required>
          </br>

          <label class="itemLogin" for="psw"><b class="itemLogin">Enter your Password</b></label>
          </br>
          <input class="inputForm" type="password" placeholder="Enter Password" name="psw" required>
          </br>
          <label class="itemLogin" for="psw"><b class="itemLogin">Confirm your Password</b></label>
          </br>
          <input class="inputForm" type="password" placeholder="Confirm Password" name="confirmePsw" required>
          </br>
          <button class="button" type="submit">Register</button>
        <a id="registerLink" href="login.php">login</a>
      </form>
    </div>
  </div>
</body>
</html>
