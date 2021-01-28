  <main>
    <!--Page Color and Header of the sign up page-->
    <body style="background-color:lightblue;">
      <center>
    <h1>Signup</h1>

    <?php
    //Checking for the error code inside the browser URL we added earlier from signup.inc.php. Then gives a message if one is there.
    //More error codes can be added here.
    if (isset($_GET['error'])){
      if ($_GET['error'] == "emptyfields"){
        echo '<p> Fill in all of the fields </p>';
      }
      else if ($_GET['error'] == "invaliduid"){
        echo '<p> Invalid Username </p>';
      }
      else if ($_GET['error'] == "usertaken"){
        echo '<p> Username Taken </p>';
      }
      else if ($_GET['error'] == "emailtaken"){
        echo '<p> Email Taken </p>';
      }
      else if ($_GET['error'] == "sqlerror"){
        echo '<p> SQL connection broken </p>';
      }
      else if ($_GET['error'] == "passwordcheck"){
        echo '<p> Passwords do not match </p>';
      }
      else if ($_GET['error'] == "invalidmail"){
        echo '<p> Email address invalid </p>';
      }
    }
    ?>

    <!--Form for the user to insert signup data. -->
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="uid" placeholder="Username" require pattern="^[a-zA-Z0-9]*$" ><br/>
      <input type="text" name="mail" placeholder="E-mail" require pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example.email@email.com"><br/>
      <input type="password" name="pwd" placeholder="Password" require pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"><br/>
      <input type="password" name="pwd-2" placeholder="Repeat Password" require pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"><br/>
      <button type="submit" name="signup">Signup</button>
    </form>
  </center>
</main>
