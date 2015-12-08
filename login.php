<?php
  session_start();
  $error='';
  if (isset($_POST['submit']))
  {
    if (empty($_POST['email']) || empty($_POST['password']))
    {
      $error = "Email or Password is invalid";
    }
    else
    {

      $username=$_POST['email'];
      $password=$_POST['password'];

      $connection = mysql_connect("localhost", "cs174", "qweasdzxc");

      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysql_real_escape_string($username);
      $password = mysql_real_escape_string($password);

      $db = mysql_select_db("bitsnbytes", $connection);

      $query = mysql_query("select * from users where password='$password' AND email='$username'", $connection);
      $rows = mysql_num_rows($query);
      if ($rows == 1)
      {
        $_SESSION['login_user']=$username;
        header("location: profile.php");
      }
      else
      {
        $error = "Username or Password is invalid";
      }
      mysql_close($connection);
    }
  }
?>
