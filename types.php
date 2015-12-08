<?php
class FoodType
{
    private $id;
    private $name;

    public function getId()    { return $this->id; }
    public function getName() { return $this->name; }
}

try {
    // Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=bitsnbytes", "root", "G0Sharks");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepared statement query.
    $query = "SELECT id, name FROM Food_Type";
    $ps = $con->prepare($query);
    $ps->execute();
    $ps->setFetchMode(PDO::FETCH_CLASS, "FoodType");

    // Construct menu options. Start with a blank option.
    print "<option value=0>$full</option>";
    while ($foodType = $ps->fetch())
    {
        $id    = $foodType->getId();
        $name = $foodType->getName();
        $full  = $name;

        print "<option value='$id'>$full</option>";
    }
}
catch(PDOException $ex) {
    print 'ERROR: '.$ex->getMessage();
}
catch(Exception $ex) {
    print 'ERROR: '.$ex->getMessage();
}
?>
