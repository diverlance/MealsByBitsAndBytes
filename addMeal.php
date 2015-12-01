<?php
    
    $con = new PDO("mysql:host=127.0.0.1;dbname=bitsnbytes", "root", "starsh1p");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $foodName = $_GET["foodName"];
    $comment = $_GET["comments"];
    $foodType = $_GET["foodType"];

    $idSmt = "select max(id) from meal";
    $idCon = $con->prepare($idSmt);
    $idCon->execute();
    $mealID = $idCon->fetchColumn(0);
    $mealID = $mealID + 1;
    
    $insertSmt = "insert into meal values(:mealID, :foodName, :id, :category, :comment)";
    $insCon = $con->prepare($insertSmt);
    $insCon->bindParam(':mealID', $mealID);
    $insCon->bindParam(':foodName', $foodName);
    $insCon->bindParam(':id', $_COOKIE["id"]);
    $insCon->bindParam(':category', $foodType);
    $insCon->bindParam(':comment', $comment);
    $insCon->execute();

?>