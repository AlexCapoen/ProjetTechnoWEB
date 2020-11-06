<div id="loginContainer">
    <div id="formLogin" class="registering">
      <form action="checkRegister.php" method='POST' class="container">
        
        <label  for="email"><b class="itemLogin">Name</b></label>
        </br>
        <input class="inputForm formBox" type="text" placeholder="John" name="Name" required>
        </br><label  for="email"><b class="itemLogin">First Name</b></label>
        </br>
        <input class="inputForm formBox" type="text" placeholder="CENA" name="FirstName" required>
        </br>

        <label  for="email"><b class="itemLogin">Email</b></label>
        </br>
        <input type="text" class="inputForm formBox" placeholder="welcome@quizzeria.com" name="email" required>
        </br>

        <label  for="email"><b class="itemLogin">Phone</b></label>
        </br>
        <input type="text" class="inputForm formBox" placeholder="0690 12 34 56" name="phone" required>
        </br>

        <label  for="email"><b class="itemLogin">Birthdate</b></label>
        </br>
        <input type="datetime-local" class="inputForm formBox" placeholder="01/01/1945" name="birthdate" required>
        </br>

        <label class="itemLogin" for="psw"><b class="itemLogin">Password</b></label>
        </br>
        <input class="inputForm formBox"  type="password" placeholder="Enter Password" name="psw" required>
        
        </br>
        <input class="inputForm formBox" type="password" placeholder="Confirm Password" name="confirmePsw" required>
        </br>
        </br>
        <button class="buttonLoginRegister" type="submit" name='register'>Register</button>
        </br>
        </br>
        <a id="registerLoginLink" href="index.php?page=login">Log In</a>
      </form>
    </div>

</div>

