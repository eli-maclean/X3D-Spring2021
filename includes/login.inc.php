<?php
//<<A lot of this code is similar to the signup.inc.php so there will be less comments.>>
if (isset($_POST['login'])) {
  require_once("../dbcontroller.php");
  $db_handle = new DBController();
  $conn = $db_handle->connectDB();

  //Taking the variables the user gave to us for an attempted login.
  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  //Checking to see if the email or password was empty
  if (isset($mailuid) && isset($password)){
    //Allows login from either username or email.
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    //Initilizes connection from dbh.inc.php
    $stmt = mysqli_stmt_init($conn);
    //Essentially error checking if the above SQL statement works with the database.
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../feedback.php?error=sqlerror");
        exit();
      }else {
      //Passing the inputted user data to the database. "ss" for two strings. Then executes.
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      //Checking to see if we have results, then assigning it to a variable.
      if ($row = mysqli_fetch_assoc($result)){
        //The function password_verify takes the two passwords (hashes, technically) and makes sure they're the same.
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        //password_verify is a boolean. If false sends back to index.php
        if ($pwdCheck == false) {
          header("Location: ../feedback.php?error=incorrectpwd");
          exit();
        }

        //If true, a session begins.
        else if($pwdCheck == true) {
          session_start();
          //Session variable only avaliable for the lenghth of the session.
          //Getting variable from the respective $rows inside the database
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUsers'];

          header("Location: ../feedback.php?login=success");
          exit();
        }

        //While it should be impossible not to get 'true or false,' this is essentially a catch all.
        //You don't want the catch all to be a successful login.
        else {
          header("Location: ../feedback.php?error=verificationerror");
          exit();
        }
      }

      //Error Checking - If user isn't found, give message and send back to the page.
      else {
        header("Location: ../feedback.php?error=nouser");
        exit();
      }
    }
  }
}
//If something else unexpectedly happens it just sends you back to feedback.php
else {
  header("Location: ../feedback.php");
  exit();
}
