<?php
  include('session.php');
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Meals by Bits&Bytes</title>
    <script src="external/jquery/jquery.js"></script>
    <script type="text/javascript">

        function hideItems()
        {
            document.getElementById("items").style.visibility = "hidden";
        }

        function showItems()
        {
            document.getElementById("items").style.visibility = "visible";
        }

        function changeItemsColor(color)
        {
            document.getElementById("items").style.backgroundColor = color;
        }

        function changeBGColor(color)
        {
            document.body.style.backgroundColor = color;
        }

        function reloadPage()
        {
            location.reload();
        }

    </script>
<script>
      $(function () {
        $('#add_meal').on('submit', function (e) {
          e.preventDefault();
          var data = $('#add_meal').serialize();
          $.ajax({
            type: 'get',
            url: 'addMeal.php',
            data: data
          });
        });
      });
    </script>

</head>

<body>

    <p>
      <?php

          echo "<h4 class='title'>by BitsAndBytes</h4>";
          echo "<hr>";

          echo "<form id='add_meal' action='addMeal.php' method='get'>";
          echo "<p class='fields'> <div class='row'>";
          echo "<label for='foodName'>Food Name</label>";
          echo "<input type='text' name='foodName'/>";
          echo "</div>";
          echo "<div class='row'>";
          echo "<label for='servings'>Servings</label>";
          echo "<input type='text' name='servings'/>";
          echo "</div>";
          echo "<div class='row'>";
          echo "<label for='foodType'>Time</label>";
          echo "<select name='foodType'>";
          echo "<option value='1'>Breakfast</option>";
          echo "<option value='2'>Lunch</option>";
          echo "<option value='5'>Snack</option>";
          echo "<option value='4'>Dinner</option>";
          echo "</select>";
          echo "</div>";
          echo "<div class='row'>";
          echo "<label for='comments'>Comments</label>";
          echo "<input type='text' name='comments'/>";
          echo "</div>";
          echo "<input type='submit' value='Add' onclick='reloadPage()'/>";
          echo "</form>";
          echo "</div>";

          try
          {
            $mealQuery = "SELECT Meal.name as 'Meal', Meal_Category.name as 'Category', Meal.comment as 'Comments' ".
           "FROM Meal, Meal_Category ".
           "WHERE Meal.user_id = $userID_session AND Meal_Category.id = Meal.category_id";
            $itemQuery = "SELECT Food.name as 'Name of Item', Food_Type.name as 'Type of Food', Food.calories as 'Calories' ".
             "FROM Meal, Meal_Item, Food, Food_Type ".
             "WHERE Meal.user_id = $userID_session AND Meal_Item.meal_id = Meal.id AND Food.id = Meal_Item.food_id ".
             "AND Food_Type.id = Food.type_id";
              $mealdata = $con->query($mealQuery);
              $mealdata->setFetchMode(PDO::FETCH_ASSOC);
              print "<table border='1'>\n";
              $doHeader = true;
              foreach ($mealdata as $row)
              {
                  if ($doHeader)
                  {
                      print "        <tr>\n";
                      foreach ($row as $name => $value)
                      {
                          print "            <th>$name</th>\n";
                      }
                      print "        </tr>\n";

                      $doHeader = false;
                  }
                  print "            <tr onclick='SelectRow(1)' id='row_1,1'>\n";
                  foreach ($row as $name => $value)
                  {
                      print "                <td>$value</td>\n";
                  }
                  print "            </tr>\n";
              }
              print "        </table>";
              print "        <br>";
              print "        <br>";
              print "        <h3>Meal Contents</h3>";
              $itemdata = $con->query($itemQuery);
              $itemdata->setFetchMode(PDO::FETCH_ASSOC);
              print "<table border='1' id='items'>\n";
              $doHeader = true;
              foreach ($itemdata as $row)
              {
                  if ($doHeader)
                  {
                      print "        <tr>\n";
                      foreach ($row as $name => $value)
                      {
                          print "            <th>$name</th>\n";
                      }
                      print "        </tr>\n";

                      $doHeader = false;
                  }
                  print "            <tr>\n";
                  foreach ($row as $name => $value)
                  {
                      print "                <td>$value</td>\n";
                  }
                  print "            </tr>\n";
              }
              print "        </table>\n";
          }
          catch(PDOException $ex)
          {
              echo 'ERROR: '.$ex->getMessage();
          }
        ?>
    </p>
    <b id="logout"><a href="logout.php">Log Out</a><b>
    </form>
</body>
</html>
