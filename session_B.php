<?php
try
{
  $con = new PDO("mysql:host=localhost;dbname=bitsnbytes", "cs174", "qweasdzxc");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  session_start();

  $user_check=$_SESSION['login_user'];

  $ses_sql = $con->prepare("SELECT email FROM users WHERE email=:uemail");
  $ses_sql->bindparam(":uemail", $user_check);
  $ses_sql->execute();

  $row = $ses_sql->fetch(PDO::FETCH_ASSOC);
  $login_session =$row['email'];
  if(!isset($login_session))
  {
    mysql_close($connection);
    header('Location: index.php');
  }
  $ses_sql = $con->prepare("SELECT * FROM users WHERE email=:uemail");
  $ses_sql->bindparam(":uemail", $user_check);
  $ses_sql->execute();

  $row = fetch(PDO::FETCH_ASSOC);

  $userID_session = $row['id'];
  $first_session = $row['first_name'];
  $last_session = $row['last_name'];
  $email_session = $row['email'];
}
catch(PDOException $e)
{
}
?>
