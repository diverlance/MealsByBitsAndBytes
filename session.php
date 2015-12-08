<?php
  $connection = mysql_connect("localhost", "cs174", "qweasdzxc");

  $db = mysql_select_db("bitsnbytes", $connection);
  session_start();

  $user_check=$_SESSION['login_user'];
  $ses_sql=mysql_query("select email from users where email='$user_check'", $connection);
  $row = mysql_fetch_assoc($ses_sql);
  $login_session =$row['email'];
  if(!isset($login_session))
  {
    mysql_close($connection);
    header('Location: index.php');
  }
  $ses_sql=mysql_query("select * from users where email='$user_check'", $connection);
  $row = mysql_fetch_assoc($ses_sql);
  $userID_session =$row['id'];
  $first_session =$row['first_name'];
  $last_session =$row['last_name'];
  $email_session =$row['email'];

  try
  {
    $con = new PDO("mysql:host=localhost;dbname=bitsnbytes", "cs174", "qweasdzxc");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {

  }
?>
