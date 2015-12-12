<?php
  include('session.php');
?>
<?php

    $mealName = $_GET["mealName"];
    $comment = $_GET["comments"];
    $servingsType = $_GET["servingsType"];

    $servings = $_GET["servings"];

    $foodName = $_GET["foodName"];
    $type_id = $_GET["foodType"];
    $calories = $_GET["calories"];

    $idSmt = "select max(id) from meal";
    $idCon = $con->prepare($idSmt);
    $idCon->execute();
    $mealID = $idCon->fetchColumn(0);
    $mealID = $mealID + 1;

    $insertSmt = "insert into meal values(:mealID, :mealName, :id, :category, :comment)";
    $insCon = $con->prepare($insertSmt);
    $insCon->bindParam(':mealID', $mealID);
    $insCon->bindParam(':mealName', $mealName);
    $insCon->bindParam(':id', $userID_session);
    $insCon->bindParam(':category', $servingsType);
    $insCon->bindParam(':comment', $comment);
    $insCon->execute();

    $idSmt = "select max(id) from food";
    $idCon = $con->prepare($idSmt);
    $idCon->execute();
    $foodID = $idCon->fetchColumn(0);
    $foodID = $foodID + 1;

    $insertSmt = "insert into food values(:foodID, :foodName, :type_id, :calories)";
    $insCon = $con->prepare($insertSmt);
    $insCon->bindParam(':foodID', $foodID);
    $insCon->bindParam(':foodName', $foodName);
    $insCon->bindParam(':type_id', $type_id);
    $insCon->bindParam(':calories', $calories);
    $insCon->execute();

    $insertSmt = "insert into meal_item values(:mealID, :foodID, :servings)";
    $insCon = $con->prepare($insertSmt);
    $insCon->bindParam(':mealID', $mealID);
    $insCon->bindParam(':foodID', $foodID);
    $insCon->bindParam(':servings', $servings);
    $insCon->execute();
?>
