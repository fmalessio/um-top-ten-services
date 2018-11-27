<?php
class TopTen {
 
    // database connection and table name
    private $conn;
    private $table_name = "um_top_ten";
 
    // object properties
    public $id;
    public $name;
    public $attempts;
    public $date;

    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT `id`, `name`, `attempts`, `date` FROM " . $this->table_name . " ORDER BY `attempts`, `date`";
 
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $num = $stmt->rowCount();

        $topTen_arr=array();
        $topTen_arr["score"]=array();

        // check if more than 0 record found
        if($num > 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
        
                $topTenItem=array(
                    "id" => $id,
                    "name" => html_entity_decode($name),
                    "attempts" => $attempts,
                    "date" => $date
                );
        
                array_push($topTen_arr["score"], $topTenItem);
            }
        }

        return $topTen_arr;
    }

    function addToTopTen() {
        /* Insert multiple records on an all-or-nothing basis */
        $topTen_arr = $this->read();

        $lastPlayInTopTen = end($topTen_arr["score"]);

        if(sizeof($topTen_arr["score"]) < 10) {
            $this->create();
        } else {
            if($newPlay->attempts < $lastPlayInTopTen->attempts) {
                $lastPlayInTopTen->delete();
                $this->create();
            }
        }

        // Lock and Unlock
        // $stmt = $this->conn->prepare("LOCK TABLES " . $this->table_name . " WRITE");
        // $stmt = $this->conn->prepare("UNLOCK TABLES");

        return true;
    }

    function create() {
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, attempts=:attempts, date=:date";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->attempts));
        $this->description=htmlspecialchars(strip_tags($this->date));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":attempts", $this->attempts);
        $stmt->bindParam(":date", $this->date);

        // execute query
        return $stmt->execute();
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    function reset() {
        $query = "DELETE FROM " . $this->table_name;
        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

}
?>