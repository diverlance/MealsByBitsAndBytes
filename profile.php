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
        function reloadPage()
        {
            location.reload();
        }
    </script>
<script>
      $(function ()
      {
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

            <h4 class='title'>by BitsAndBytes</h4>
            <hr>

            <form id='add_meal' action='addMeal.php' method='get'>
            <p class='fields'>
            <div class='row'>
            <label for='mealName'>Meal Name</label>
            <input type='text' name='mealName' required="true"/>
            </div>
            <div class='row'>
            <label for='foodName'>Food Name</label>
            <input type='text' name='foodName' required="true"/>
            </div>
            <div class='row'>
            <label for='Caloties'>Caloties </label>
            <input type='text' name='calories' required="true"/>
            </div>
            <div>
            	<label>Food Type </label>
              </br><input type="radio" name="foodType" value="1" checked /> Meat
              </br><input type="radio" name="foodType" value="2" /> Poultry
              </br><input type="radio" name="foodType" value="5" /> Seafood
              </br><input type="radio" name="foodType" value="7" /> Fruit
              </br><input type="radio" name="foodType" value="8" /> Vegetable
              </br><input type="radio" name="foodType" value="9" /> Others
           	</div>
            <div class='row'>
            <label for='servings'>Servings</label>
            <input type='text' name='servings' required="true"/>
            </div>
            <div class='row'>
              <label for='servingsType'>Time</label>
              <select name='servingsType'>
                <option value='1'>Breakfast</option>
                <option value='2'>Lunch</option>
                <option value='5'>Snack</option>
                <option value='4'>Dinner</option>
              </select>
            </div>
            <div class='row'>
            <label for='comments'>Comments</label>
            <input type='text' name='comments' required="true"/>
            </div>
            <input type='submit' value='Add' onclick='reloadPage()'/>
            </form>
            </div>
    <p>
      <?php

          try
          {
            $mealQuery = "SELECT Meal.name as 'Meal', Meal_Category.name as 'Category', Meal.comment as 'Comments' ".
           "FROM Meal, Meal_Category ".
           "WHERE Meal.user_id = $userID_session AND Meal_Category.id = Meal.category_id";
           $itemQuery = "SELECT Food.name as 'Name of Item', Food_Type.name as 'Type of Food', Food.calories as 'Calories' ".
            "FROM Meal, Meal_Item, Food, Food_Type ".
            "WHERE Meal.user_id = $userID_session AND Meal_Item.meal_id = Meal.id AND Food.id = Meal_Item.food_id ".
            "AND Food_Type.id = Food.type_id";
            $caloriesQuery = "SELECT SUM(Food.calories) as 'totalCalories'".
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

              $sumCalories = $con->query($caloriesQuery);
              $sumCalories = $sumCalories->fetch(PDO::FETCH_ASSOC);
              $totalCalories = $sumCalories['totalCalories'];

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
              print "<tr><td colspan=3> Total Calories : $totalCalories </td></tr>";
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
