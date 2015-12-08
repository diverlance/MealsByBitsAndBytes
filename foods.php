<?php
class Food
{
    private $id;
    private $name;
    private $calories;

    public function getId()   { return $this->id; }
    public function getName()    { return $this->name; }
    public function getCalories() { return $this->calories; }
}

$foodTypeID = filter_input(INPUT_POST, 'id');
if ($foodTypeID == 0) return;

try {
    // Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=bitsnbytes", "root", "G0Sharks");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepared statement query.
    $query = "SELECT id, name, calories FROM Food WHERE type_id = :type_id ";
    $ps = $con->prepare($query);
    $ps->bindParam(':type_id', $foodTypeID);
    $ps->execute();

    createTable($ps);
}
catch(PDOException $ex) {
    print 'ERROR: '.$ex->getMessage();
}
catch(Exception $ex) {
    print 'ERROR: '.$ex->getMessage();
}

function createTable(PDOStatement $ps)
{
    print "<table>\n";
    createHeaderRow($ps);
    $ps->execute();
    $ps->setFetchMode(PDO::FETCH_CLASS, "Food");

    // Construct the data rows.
    while ($ss = $ps->fetch()) {
        print "<tr>\n";
        createDataRow($ss);
        print "</tr>\n";
    }

    print "</table>\n";
}

function createHeaderRow(PDOStatement $ps)
{
    $row = $ps->fetch(PDO::FETCH_ASSOC);
    print "<tr>\n";
    foreach ($row as $field => $value) {
        print "<th>$field</th>\n";
    }
    print "</tr>\n";
}

function createDataRow(Food $ss)
{
    print "<tr>\n";
    print "<td>" . $ss->getId()   . "</td>\n";
    print "<td>" . $ss->getName()    . "</td>\n";
    print "<td>" . $ss->getName()    . "</td>\n";
    print "<td>" . $ss->getCalories() . "</td>\n";
    print "</tr>\n";
}
?>
