<?php
  $error='';
  $first = $_POST['first'];
  $last = $_POST['last'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];

  if (isset($_POST['submit']))
  {
    if ($repassword != $password)
    {
      $error = "Password is not matched!";
    }
    else
    {
      try
      {
        $con = new PDO("mysql:host=localhost;dbname=bitsnbytes", "cs174", "qweasdzxc");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Users (first_name, last_name, email, password) VALUES ('$first', '$last', '$email', '$password');";
        $con->exec($sql);
        header("Location: index.php");
      }
      catch(PDOException $e)
      {
        echo $sql . "<br>" . $e->getMessage();
      }
    }
  }
?>
