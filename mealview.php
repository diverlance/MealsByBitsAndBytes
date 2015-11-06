<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Meals by Bits&Bytes</title>
    <link rel="stylesheet" href="jquery-ui.css">
    <script src="script.js"></script>
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


</head>

<body>

    
    <p>
        <?php
            $first = filter_input(INPUT_GET, "first_name");
            $last  = filter_input(INPUT_GET, "last_name");
            $email = filter_input(INPUT_GET, "email");
           
			echo "<h1 class='title'>Meals by BitsAndBytes</h1>";
			echo "<hr>";
			echo "<h2 class='add-member'>Meals for " . $first . " " . $last . "</h3>";

            try
            {
                $con = new PDO("mysql:host=localhost;dbname=bitsnbytes", "root", "mybirthdayis0212");
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if(strlen($email) > 0)
                {
                	$emailQuery = "SELECT id FROM Users WHERE email = '$email'";
                	$emailStmt = $con->query($emailQuery);
                	$userId = $emailStmt -> fetchColumn(0);
                	if ($userId == false) 
                	{
                		$insertQuery = "INSERT INTO Users ".
                		 "VALUES (NULL, '$first', '$last', '$email')";
                		 $con->query($insertQuery);
                	
                	
                	$usrquery = "SELECT id ".
							 "FROM Users ".
							 "WHERE Users.email = '$email' ";
							 
							 $usrStmt = $con->query($usrquery);
                	$userId = $usrStmt -> fetchColumn(0);
					}
                }

				if ($userId > 0)
				{
                $mealQuery = "SELECT Meal.name as 'Meal', Meal_Category.name as 'Category', Meal.comment as 'Comments' ".
						 "FROM Meal, Meal_Category ".
						 "WHERE Meal.user_id = $userId AND Meal_Category.id = Meal.category_id";
				$itemQuery = "SELECT Food.name as 'Name of Item', Food_Type.name as 'Type of Food', Food.calories as 'Calories' ". 
							 "FROM Meal, Meal_Item, Food, Food_Type ".
							 "WHERE Meal.user_id = $userId AND Meal_Item.meal_id = Meal.id AND Food.id = Meal_Item.food_id ".
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
   		 }
            catch(PDOException $ex)
            {
                echo 'ERROR: '.$ex->getMessage();
            }
        ?>
    </p>
    <form action="">
        <fieldset>
            <div id="accordion">
                <h3>BUTTONS</h3>
            <legend>Interactive buttons</legend>
            <p>
                <input type="button" value="Hide Meal Items"
                       onclick="hideItems()" />
                <input type="button" value="Show Meal Items"
                       onclick="showItems()" />
                <input type="button" value="Red Items"
                       onclick="changeItemsColor('red')" />
                <input type="button" value="Green Items"
                       onclick="changeItemsColor('green')" />
                <input type="button" value="Blue Items"
                       onclick="changeItemsColor('blue')" />
                <input type="button" value="Red Background"
                       onclick="changeBGColor('red')" />
                <input type="button" value="Green Background"
                       onclick="changeBGColor('green')" />
                <input type="button" value="Blue Background"
                       onclick="changeBGColor('blue')" />
                <input type="button" value="Reload Page"
                       onclick="reloadPage()" />      
            </p>

            </div>
          
        </fieldset>
    </form>

    <script>
        $(document).ready(function(){
            $("#date").datepicker();
            $("#accordion").accordion();
            });
    </script>
</body>
</html>
